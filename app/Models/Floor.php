<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Floor extends Model
{
    use HasFactory;

    protected $table = 'floors';
    public $timestamps = false;

    public function index()
    {
        return DB::table('floors')
            ->orderBy('id')
            ->get();
    }

    public function store()
    {
        DB::table('floors')->insert([
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
        ]);
    }

    public function edit()
    {
        return DB::table('floors')
            ->where('id', $this->id)
            ->get();
    }

    public function updateFloor()
    {
        DB::table('floors')
            ->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'description' => $this->description,
                'status' => $this->status,
            ]);
    }

    public function destroyFloor()
    {
        DB::table('floors')
            ->where('id', $this->id)
            ->delete();
    }
}
