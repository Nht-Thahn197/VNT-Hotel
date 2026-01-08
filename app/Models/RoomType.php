<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomType extends Model
{
    use HasFactory;
    protected $table = "room_types";
    public function index(){
        // Query lay du lieu
        $typerooms =DB::table('room_types')->get();
        // Tra ve du lieu
        return $typerooms;
    }
    public function store(){
        // query builder uufng để lưu dữ liệu
        DB::table('room_types')->insert([
            'name' => $this->name,
            'price' => $this->price,
            'guest' => $this->guest,
        ]);
    }
    public function edit(){
        $typerooms = DB::table('room_types')
            ->where('id',$this->id)
            ->get();
        return $typerooms;
    }
    public function updateTyperoom(){
        // query builder de update du lieu
        DB::table('room_types')->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'price' => $this->price,
                'guest' => $this->guest,
            ]);
    }
    public function destroyTyperoom(){
        DB::table('room_types')
            ->where('id', $this->id)
            ->delete();
    }
}
