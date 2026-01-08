<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;
    protected $table = "services";

    public function index()
    {
        // Query lay du lieu
        $services = DB::table('services') ->get();
        // Tra ve du lieu
        return $services;
    }

    public function store(){
        // query builder uufng để lưu dữ liệu
        DB::table('services')->insert([
            'name' => $this->name,
            'image' => $this->image,
            'price' => $this->price,
            'describe' => $this->describe
        ]);
    }

    public function edit(){
        $sercvices = DB::table('services')
            ->where('id',$this->id)
            ->get();
        return $sercvices;
    }

    public function updateService(){
        // query builder de update du lieu
        DB::table('services')->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'image' => $this->image,
                'price' => $this->price,
                'describe' => $this->describe
            ]);
    }

    public function destroyService(){
        DB::table('services')
            ->where('id', $this->id)
            ->delete();
    }
}
