<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceInvoice extends Model
{
    use HasFactory;
    protected $table = 'service_invoices';

    public function index(){
        // Query lay du lieu
        $serviceinvoices = DB::table('service_invoices')
            ->join('services', 'service_invoices.ser_id', '=', 'services.id')
            ->select('service_invoices.*',
            'services.name as ser_name')
            ->get();
        // Tra ve du lieu
        return $serviceinvoices;
    }
}
