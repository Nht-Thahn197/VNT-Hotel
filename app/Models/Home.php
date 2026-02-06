<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;
    protected $table = "invoice_detail";

    public function index(){
        $invoicedetails = DB::table('invoice_detail')->get();
        return $invoicedetails;
    }

    public function store(){
        $email = session('customer.email');
        $cusId = DB::table('customer')->where('email',$email)->value('id');
        DB::table('booking')->insert([
            'customer_id' => $cusId,
            'room_type_id' => $this->roomtype_id,
            'room_id' => null,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'booking_status' => 0
        ]);
    }

    public function show($customerId = null){
        if (!$customerId) {
            $email = session('customer.email');
            $customerId = DB::table('customer')->where('email',$email)->value('id');
        }
        $orders = DB::table('customer')
            ->join('booking', 'customer.id', '=', 'booking.customer_id')
            ->join('room_type', 'booking.room_type_id', '=', 'room_type.id')
            ->leftJoin('room', 'booking.room_id', '=', 'room.id')
            ->leftJoin('invoice', 'booking.id', '=', 'invoice.booking_id')
            ->select(
                'booking.id as booking_id',
                'booking.booking_status',
                'customer.name AS customer_name',
                'customer.email',
                'customer.phone',
                'booking.time_start',
                'booking.time_end',
                'room_type.name as room_type_name',
                'room.name as room_name',
                'invoice.status as invoice_status',
                'invoice.method as invoice_method'
            )
            ->where('customer.id', $customerId)
            ->get();
        return $orders;
    }
}
