<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;
    protected $table = "invoice_detaileds";

    public function index(){
        $invoicedetails = DB::table('invoice_detaileds')->get();
        return $invoicedetails;
    }

    public function store(){
        $email = session('customer.email');
        $cus_id = DB::table('customers')->where('email',$email)->get('id');
        DB::table('invoices')->insert([
           'status' => 0,
            'method' => $this->method,
            'cus_id' => $cus_id[0]->id,
            'ad_id' => 2
        ]);
        $invoice_id = DB::table('invoices')->where('cus_id', $cus_id[0]->id)->max('id');
        $roomPrice = DB::table('room_types')->where('id', $this->roomtype_id)->get('price');

        DB::table('invoice_detaileds')->insert([
            'invoice_id' => $invoice_id,
            'room_id' => 2,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'total' => $this->people,
            'price' => $roomPrice[0]->price
        ]);
    }

    public function show(){
        $email = session('customer.email');
        $cus_id = DB::table('customers')->where('email',$email)->get('id');
        $orders = DB::table('customers')
            ->join('invoices', 'customers.id', '=', 'invoices.cus_id')
            ->join('invoice_detaileds', 'invoices.id', '=', 'invoice_detaileds.invoice_id')
            ->join('rooms', 'invoice_detaileds.room_id', '=', 'rooms.id')
            ->select('*',
            'invoices.status',
            'customers.name AS customer_name',
            'rooms.name as room_name'
            )
//            ->join('rooms', 'rooms.id', '=', 'invoice_detaileds.room_id')
//            ->select(
//                'invoices.*',
//                'rooms.name as room_name'
//            )
            ->where('cus_id',$cus_id[0]->id)
            ->get();
        return $orders;
//        $orders = DB::table('invoices')->where('cus_id',$cus_id[0]->id)->get();
//        return $orders;
    }
}
