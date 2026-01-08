<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceDetailed extends Model
{
    use HasFactory;
    protected $table = 'invoice_detaileds';

    public function index($invoiceId){
        // Query lay du lieu
        $invoicedetails = DB::table('invoices')
            ->join('invoice_detaileds', 'invoices.id', '=', 'invoice_detaileds.invoice_id')
            ->join('rooms', 'invoice_detaileds.room_id', '=', 'rooms.id')
            ->select('invoice_detaileds.*', 'rooms.name as room_name')
            ->where('invoices.id', $invoiceId)
            ->get();
        // Tra ve du lieu
        return $invoicedetails;
    }
    public function edit(){
        $invoicedetails = DB::table('invoice_detaileds')
            ->where('id',$this->id)
            ->get();
        return $invoicedetails;
    }
    public function updateInvoicedetail(){
        // query builder de update du lieu
        DB::table('invoice_detaileds')->where('id', $this->invoice_id)
            ->update([
                'room_id' => $this->room_id
            ]);
    }
}
