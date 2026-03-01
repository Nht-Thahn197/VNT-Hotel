<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CashierController extends Controller
{
    public function index(Request $request)
    {
        $floors = DB::table('floors')
            ->orderBy('id')
            ->get();

        $activeBookings = DB::table('booking')
            ->select('room_id', DB::raw('MAX(time_start) as time_start'), DB::raw('MAX(time_end) as time_end'))
            ->where('booking_status', 2)
            ->groupBy('room_id');

        $reservedBookings = DB::table('booking')
            ->select('room_id', DB::raw('MIN(time_start) as time_start'), DB::raw('MIN(time_end) as time_end'))
            ->where('booking_status', 1)
            ->groupBy('room_id');

        $rooms = DB::table('room')
            ->leftJoin('floors', 'room.floor_id', '=', 'floors.id')
            ->leftJoin('room_type', 'room.roomtype_id', '=', 'room_type.id')
            ->leftJoinSub($activeBookings, 'active_booking', function ($join) {
                $join->on('room.id', '=', 'active_booking.room_id');
            })
            ->leftJoinSub($reservedBookings, 'reserved_booking', function ($join) {
                $join->on('room.id', '=', 'reserved_booking.room_id');
            })
            ->select(
                'room.*',
                'floors.name as floor_name',
                'room_type.name as room_type_name',
                'room_type.price_hour as room_price_hour',
                'room_type.price_overnight as room_price_overnight',
                'room_type.price_night as room_price_night',
                'active_booking.time_start as booking_time_start',
                'active_booking.time_end as booking_time_end',
                'reserved_booking.time_start as reserved_time_start',
                'reserved_booking.time_end as reserved_time_end',
                'room.checkin_at as room_checkin_at'
            )
            ->orderBy('room.floor_id')
            ->orderBy('room.name')
            ->get();

        $services = DB::table('service')
            ->orderBy('id')
            ->get();

        $now = now();
        $bookings = DB::table('booking')
            ->join('customer', 'booking.customer_id', '=', 'customer.id')
            ->join('room_type', 'booking.room_type_id', '=', 'room_type.id')
            ->leftJoin('room', 'booking.room_id', '=', 'room.id')
            ->select(
                'booking.*',
                'customer.name as customer_name',
                'customer.phone as customer_phone',
                'room_type.name as room_type_name',
                'room.name as room_name'
            )
            ->where('booking.time_start', '>=', $now)
            ->orderBy('booking.time_start')
            ->get();

        foreach ($bookings as $booking) {
            $booking->is_soon = false;
            $booking->minutes_until = null;

            if (!empty($booking->time_start)) {
                $start = Carbon::parse($booking->time_start);
                if ($start->greaterThanOrEqualTo($now)) {
                    $minutes = $now->diffInMinutes($start);
                    $booking->minutes_until = $minutes;
                    if ($minutes <= 60) {
                        $booking->is_soon = true;
                    }
                }
            }
        }

        $selectedRoomId = (int) $request->query('room_id', 0);

        return view('cashier.index', [
            'floors' => $floors,
            'rooms' => $rooms,
            'services' => $services,
            'bookings' => $bookings,
            'selectedRoomId' => $selectedRoomId,
        ]);
    }

    public function checkin(Request $request)
    {
        $roomId = (int) $request->input('room_id', 0);
        if ($roomId <= 0) {
            flash()->addError('Vui long chon phong.');
            return Redirect::route('cashier.index');
        }

        $room = DB::table('room')->where('id', $roomId)->first();
        if (!$room) {
            flash()->addError('Phong khong ton tai.');
            return Redirect::route('cashier.index');
        }

        $roomStatus = (int) $room->status;
        if ($roomStatus !== 0) {
            flash()->addError('Phong khong trong de check-in.');
            return Redirect::route('cashier.index');
        }

        $hasActiveBooking = DB::table('booking')
            ->where('room_id', $roomId)
            ->whereIn('booking_status', [1, 2])
            ->exists();
        if ($hasActiveBooking) {
            flash()->addError('Phong da co booking dang su dung.');
            return Redirect::route('cashier.index');
        }

        DB::table('room')->where('id', $roomId)->update([
            'status' => 2,
            'checkin_at' => now(),
        ]);
        flash()->addSuccess('Da check-in phong.');

        return Redirect::route('cashier.index', ['room_id' => $roomId]);
    }

    public function checkout(Request $request)
    {
        $roomId = (int) $request->input('room_id', 0);
        if ($roomId <= 0) {
            return response()->json(['ok' => false, 'message' => 'Vui lòng chọn phòng.'], 422);
        }

        $room = DB::table('room')->where('id', $roomId)->first();
        if (!$room) {
            return response()->json(['ok' => false, 'message' => 'Phòng không tồn tại.'], 404);
        }

        $booking = DB::table('booking')
            ->where('room_id', $roomId)
            ->where('booking_status', 2)
            ->orderBy('id', 'desc')
            ->first();

        $now = now();
        $bookingId = null;
        if ($booking) {
            $bookingId = $booking->id;
            DB::table('booking')->where('id', $bookingId)->update([
                'booking_status' => 3,
                'time_end' => $now,
            ]);
        } else {
            $guestEmail = 'guest@vnt.local';
            $customerId = DB::table('customer')->where('email', $guestEmail)->value('id');
            if (!$customerId) {
                $customerId = DB::table('customer')->insertGetId([
                    'name' => 'Khách lẻ',
                    'phone' => null,
                    'email' => $guestEmail,
                    'address' => 'Khách lẻ',
                    'password' => bcrypt('guest'),
                ]);
            }
            $bookingId = DB::table('booking')->insertGetId([
                'customer_id' => $customerId,
                'room_type_id' => $room->roomtype_id,
                'room_id' => $roomId,
                'time_start' => $room->checkin_at ?? $now,
                'time_end' => $now,
                'booking_status' => 3,
            ]);
            $booking = (object) [
                'id' => $bookingId,
                'customer_id' => $customerId,
                'time_start' => $room->checkin_at ?? $now,
                'time_end' => $now,
                'room_type_id' => $room->roomtype_id,
            ];
        }

        $methodMap = [
            'cash' => 1,
            'transfer' => 2,
            'card' => 3,
        ];
        $methodValue = $methodMap[$request->input('method')] ?? 1;

        $invoice = DB::table('invoice')->where('booking_id', $bookingId)->first();
        if ($invoice) {
            $invoiceId = $invoice->id;
            DB::table('invoice')->where('id', $invoiceId)->update([
                'status' => 2,
                'method' => $methodValue,
            ]);
        } else {
            $adminId = session('admin')->id ?? null;
            $invoiceId = DB::table('invoice')->insertGetId([
                'booking_id' => $bookingId,
                'status' => 2,
                'method' => $methodValue,
                'cus_id' => $booking->customer_id ?? null,
                'ad_id' => $adminId,
            ]);
        }

        DB::table('invoice_detail')->where('invoice_id', $invoiceId)->delete();

        $roomType = DB::table('room_type')->where('id', $booking->room_type_id)->first();
        if ($roomType) {
            [$quantity, $unitPrice, $total, $description] = $this->calculateRoomCharge($booking->time_start, $booking->time_end, $roomType);
            DB::table('invoice_detail')->insert([
                'invoice_id' => $invoiceId,
                'description' => $description,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'price' => $unitPrice,
                'total' => $total,
            ]);
        }

        $items = $request->input('items');
        if ($items) {
            $decoded = json_decode($items, true);
            if (is_array($decoded)) {
                foreach ($decoded as $item) {
                    $name = $item['name'] ?? 'Dịch vụ';
                    $qty = (int) ($item['qty'] ?? 1);
                    $unit = (float) ($item['price'] ?? 0);
                    $total = $qty * $unit;
                    if ($qty > 0 && $unit > 0) {
                        DB::table('invoice_detail')->insert([
                            'invoice_id' => $invoiceId,
                            'description' => 'Service: ' . $name,
                            'quantity' => $qty,
                            'unit_price' => $unit,
                            'price' => $unit,
                            'total' => $total,
                        ]);
                    }
                }
            }
        }

        DB::table('room')->where('id', $roomId)->update([
            'status' => 0,
            'checkin_at' => null,
        ]);

        return response()->json(['ok' => true]);
    }

    private function calculateRoomCharge($start, $end, $roomType)
    {
        $startAt = new \DateTime($start);
        $endAt = new \DateTime($end);
        $durationSeconds = $endAt->getTimestamp() - $startAt->getTimestamp();
        if ($durationSeconds <= 0) {
            return [1, (float) $roomType->price_night, (float) $roomType->price_night, 'Room charge (daily)'];
        }

        $hours = $durationSeconds / 3600;
        $startHour = (int) $startAt->format('H');
        $endHour = (int) $endAt->format('H');
        $isOvernight = ($startAt->format('Y-m-d') != $endAt->format('Y-m-d')) && ($startHour >= 21) && ($endHour <= 8);

        if ($hours < 6) {
            $quantity = (int) ceil($hours);
            $unitPrice = (float) $roomType->price_hour;
            $total = $quantity * $unitPrice;
            return [$quantity, $unitPrice, $total, 'Room charge (hourly)'];
        }

        if ($isOvernight) {
            $unitPrice = (float) $roomType->price_overnight;
            return [1, $unitPrice, $unitPrice, 'Room charge (overnight)'];
        }

        if ($hours >= 24) {
            $quantity = (int) ceil($hours / 24);
            $unitPrice = (float) $roomType->price_night;
            $total = $quantity * $unitPrice;
            return [$quantity, $unitPrice, $total, 'Room charge (daily)'];
        }

        $unitPrice = (float) $roomType->price_night;
        return [1, $unitPrice, $unitPrice, 'Room charge (daily)'];
    }
}
