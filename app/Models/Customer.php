<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable;

    protected $fillable = ['name', 'phone', 'email', 'address', 'password', 'id_card'];
    public $timestamps = false;
    protected $table = 'customer';

    public function index(){
        // Query lay du lieu
        $customers =DB::table('customer')->get();
        // Tra ve du lieu
        return $customers;
    }

    public function show(){
        // Query lay du lieu
        $email = session('customer.email');
        $cus_id = DB::table('customer')->where('email',$email)->get('id');
        $customers = DB::table('customer')
            ->where('id',$cus_id[0]->id)
            ->get();
        // Tra ve du lieu
        return $customers;
    }

    public function store(){
        // query builder uufng để lưu dữ liệu
        DB::table('customer')->insert([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'password' => $this->password,
            'id_card' => $this->id_card
        ]);
    }
    public function edit(){
        $customers = DB::table('customer')
            ->where('id',$this->id)
            ->get();
        return $customers;
    }
    public function updateCustomer(){
        // query builder de update du lieu
        DB::table('customer')->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
                'password' => $this->password,
                'id_card' => $this->id_card
            ]);
    }
    public function destroyCustomer(){
        DB::table('customer')
            ->where('id', $this->id)
            ->delete();
    }
}
