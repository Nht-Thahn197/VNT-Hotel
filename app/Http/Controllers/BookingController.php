<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('booking')
            ->join('customer', 'booking.customer_id', '=', 'customer.id')
            ->join('room_type', 'booking.room_type_id', '=', 'room_type.id')
            ->leftJoin('room', 'booking.room_id', '=', 'room.id')
            ->leftJoin('invoice', 'booking.id', '=', 'invoice.booking_id')
            ->select(
                'booking.*',
                'customer.name as customer_name',
                'customer.phone',
                'customer.email',
                'room_type.name as room_type_name',
                'room.name as room_name',
                'invoice.id as invoice_id',
                'invoice.status as invoice_status',
                'invoice.method as invoice_method'
            )
            ->orderBy('booking.id', 'desc')
            ->get();

        return view('booking.index', ['bookings' => $bookings]);
    }
}
