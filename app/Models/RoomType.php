<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomType extends Model
{
    use HasFactory;
    protected $table = "room_type";
    public function index(){
        // Query lay du lieu
        $typerooms =DB::table('room_type')->get();
        // Tra ve du lieu
        return $typerooms;
    }
    public function store(){
        // query builder uufng để lưu dữ liệu
        DB::table('room_type')->insert([
            'name' => $this->name,
            'price_hour' => $this->price_hour,
            'price_overnight' => $this->price_overnight,
            'price_night' => $this->price_night,
            'max_guest' => $this->max_guest,
            'guest' => $this->guest,
        ]);
    }
    public function edit(){
        $typerooms = DB::table('room_type')
            ->where('id',$this->id)
            ->get();
        return $typerooms;
    }
    public function updateTyperoom(){
        // query builder de update du lieu
        DB::table('room_type')->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'price_hour' => $this->price_hour,
                'price_overnight' => $this->price_overnight,
                'price_night' => $this->price_night,
                'max_guest' => $this->max_guest,
                'guest' => $this->guest,
            ]);
    }
    public function destroyTyperoom(){
        DB::table('room_type')
            ->where('id', $this->id)
            ->delete();
    }
}
