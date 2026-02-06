<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $fillable = ['status'];
    public $timestamps = false;




    public function index(){
        // Query lay du lieu
        $invoices = DB::table('invoice')
            ->join('customer', 'invoice.cus_id', '=', 'customer.id')
            ->select(
                'invoice.*',
                'customer.name as customer_name'
            )
            ->get();
        // Tra ve du lieu
        return $invoices;
    }
}
