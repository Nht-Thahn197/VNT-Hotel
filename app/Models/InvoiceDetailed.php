<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceDetailed extends Model
{
    use HasFactory;
    protected $table = 'invoice_detail';
    public $timestamps = false;

    public function index($invoiceId){
        // Query lay du lieu
        $invoicedetails = DB::table('invoice_detail')
            ->join('invoice', 'invoice_detail.invoice_id', '=', 'invoice.id')
            ->join('booking', 'invoice.booking_id', '=', 'booking.id')
            ->leftJoin('room', 'booking.room_id', '=', 'room.id')
            ->select(
                'invoice_detail.*',
                'booking.id as booking_id',
                'booking.time_start',
                'booking.time_end',
                'booking.room_id',
                'room.name as room_name'
            )
            ->where('invoice.id', $invoiceId)
            ->get();
        // Tra ve du lieu
        return $invoicedetails;
    }
    public function edit(){
        $bookings = DB::table('invoice')
            ->join('booking', 'invoice.booking_id', '=', 'booking.id')
            ->select(
                'booking.id as booking_id',
                'booking.room_id',
                'invoice.id as invoice_id'
            )
            ->where('invoice.id', $this->invoice_id)
            ->get();
        return $bookings;
    }
    public function updateInvoicedetail(){
        // query builder de update du lieu
        $bookingId = DB::table('invoice')
            ->where('id', $this->invoice_id)
            ->value('booking_id');
        if ($bookingId) {
            DB::table('booking')->where('id', $bookingId)
                ->update([
                    'room_id' => $this->room_id
                ]);
        }
    }
}
