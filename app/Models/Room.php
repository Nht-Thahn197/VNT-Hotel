<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';

    public function index(){
        // Query lay du lieu
        $rooms = DB::table('rooms')
            ->join('room_types', 'rooms.roomtype_id', '=', 'room_types.id')
            ->select('rooms.*',
            'room_types.name as roomtype_name'
            )
            ->get();
        // Tra ve du lieu
        return $rooms;
    }

    public function create(){
        $typerooms = DB::table('room_types')->get();
        return $typerooms;
    }

    public function store(){
        // query builder uufng để lưu dữ liệu
        DB::table('rooms')->insert([
            'name' => $this->name,
            'floor' => $this->floor,
            'status' => $this->status,
            'roomtype_id' => $this->id
        ]);
    }

    public function edit(){
        $rooms = DB::table('rooms')
            ->where('id',$this->id)
            ->get();
        return $rooms;
    }

    public function updateRoom(){
        // query builder de update du lieu
        DB::table('rooms')->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'floor' => $this->floor,
                'status' => $this->status,
                'roomtype_id' => $this->id
            ]);
    }
    public function destroyRoom(){
        DB::table('rooms')
            ->where('id', $this->id)
            ->delete();
    }
}
