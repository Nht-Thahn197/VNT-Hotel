<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\InvoiceDetailed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = DB::table('invoice as i')
            ->leftJoin('booking as b', 'i.booking_id', '=', 'b.id')
            ->leftJoin('customer as c', 'i.cus_id', '=', 'c.id')
            ->leftJoin('invoice_detail as d', 'i.id', '=', 'd.invoice_id')
            ->select(
                'i.id',
                'i.booking_id',
                'i.status',
                'i.method',
                'i.cus_id',
                'i.ad_id',
                'b.time_start',
                'b.time_end',
                'c.name as customer_name',
                DB::raw('COALESCE(SUM(d.total), 0) as total_amount')
            )
            ->groupBy(
                'i.id',
                'i.booking_id',
                'i.status',
                'i.method',
                'i.cus_id',
                'i.ad_id',
                'b.time_start',
                'b.time_end',
                'c.name'
            )
            ->orderBy('i.id', 'desc')
            ->get();

        return view('invoice.index', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function updateStatus($id)
    {
        $booking = DB::table('booking')->where('id', $id)->first();
        if (!$booking) {
            return redirect()->back();
        }
        if ((int) $booking->booking_status != 0) {
            return redirect()->back();
        }

        if (!Booking::hasAvailability($booking->room_type_id, $booking->time_start, $booking->time_end, $booking->id)) {
            DB::table('booking')->where('id', $id)->update(['booking_status' => 4]);
            flash()->addError('Khong con phong trong, booking da bi huy.');
            return redirect()->back();
        }

        DB::table('booking')->where('id', $id)->update(['booking_status' => 1]);
        flash()->addSuccess('Da xac nhan booking.');
        return redirect()->back();
    }

    public function mini($id)
    {
        $invoice = DB::table('invoice')->where('booking_id', $id)->first();
        if (!$invoice) {
            flash()->addError('Chua co hoa don de thanh toan.');
            return redirect()->back();
        }
        if ((int) $invoice->status <= 1) {
            DB::table('invoice')->where('id', $invoice->id)->update([
                'status' => 2,
                'method' => 1,
            ]);
            flash()->addSuccess('Da thanh toan.');
        }

        return redirect()->back();
    }

    public function restore($id)
    {
        $booking = DB::table('booking')->where('id', $id)->first();
        if (!$booking || (int) $booking->booking_status != 2) {
            return redirect()->back();
        }

        $roomType = DB::table('room_type')->where('id', $booking->room_type_id)->first();
        if (!$roomType) {
            return redirect()->back();
        }

        [$quantity, $unitPrice, $total, $description] = $this->calculateRoomCharge($booking->time_start, $booking->time_end, $roomType);

        $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();
        if ($invoice) {
            $invoiceId = $invoice->id;
        } else {
            $adminId = session('admin')->id ?? null;
            $invoiceId = DB::table('invoice')->insertGetId([
                'booking_id' => $booking->id,
                'status' => 1,
                'method' => 0,
                'cus_id' => $booking->customer_id,
                'ad_id' => $adminId,
            ]);
        }
        if ($invoice && (int) $invoice->status == 0) {
            DB::table('invoice')->where('id', $invoiceId)->update(['status' => 1]);
        }

        DB::table('invoice_detail')
            ->where('invoice_id', $invoiceId)
            ->where('description', 'like', 'Room charge%')
            ->delete();

        DB::table('invoice_detail')->insert([
            'invoice_id' => $invoiceId,
            'description' => $description,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'price' => $unitPrice,
            'total' => $total,
        ]);

        DB::table('booking')->where('id', $booking->id)->update(['booking_status' => 3]);
        if ($booking->room_id) {
            DB::table('room')->where('id', $booking->room_id)->update(['status' => 0]);
        }

        flash()->addSuccess('Da check-out va lap hoa don.');
        return redirect()->back();
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
