<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceInvoice extends Model
{
    use HasFactory;
    protected $table = 'invoice_detail';

    public function index(){
        // Query lay du lieu
        $serviceinvoices = DB::table('invoice_detail')
            ->select('invoice_detail.*')
            ->get();
        // Tra ve du lieu
        return $serviceinvoices;
    }
}
