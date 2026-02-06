<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;
    protected $table = 'room';

    public function index(){
        // Query lay du lieu
        $rooms = DB::table('room')
            ->join('room_type', 'room.roomtype_id', '=', 'room_type.id')
            ->leftJoin('floors', 'room.floor_id', '=', 'floors.id')
            ->select(
                'room.*',
                'room_type.name as roomtype_name',
                'floors.name as floor_name',
                'floors.status as floor_status'
            )
            ->get();
        // Tra ve du lieu
        return $rooms;
    }

    public function create(){
        $typerooms = DB::table('room_type')->get();
        return $typerooms;
    }

    public function store(){
        // query builder uufng để lưu dữ liệu
        DB::table('room')->insert([
            'name' => $this->name,
            'floor_id' => $this->floor_id,
            'status' => $this->status,
            'roomtype_id' => $this->roomtype_id
        ]);
    }

    public function edit(){
        $rooms = DB::table('room')
            ->where('id',$this->id)
            ->get();
        return $rooms;
    }

    public function updateRoom(){
        // query builder de update du lieu
        DB::table('room')->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'floor_id' => $this->floor_id,
                'status' => $this->status,
                'roomtype_id' => $this->roomtype_id
            ]);
    }
    public function destroyRoom(){
        DB::table('room')
            ->where('id', $this->id)
            ->delete();
    }
}
