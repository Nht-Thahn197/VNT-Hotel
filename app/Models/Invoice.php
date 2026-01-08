<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = ['status'];
    public $timestamps = false;




    public function index(){
        // Query lay du lieu
        $invoices = DB::table('invoices')
            ->join('customers', 'invoices.cus_id', '=', 'customers.id')
            ->select(
                'invoices.*',
                'customers.name as customer_name'
            )
            ->get();
        // Tra ve du lieu
        return $invoices;
    }
}
