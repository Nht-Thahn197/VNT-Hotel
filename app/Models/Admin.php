<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable;
    protected $fillable = ['name','phone','email','password'];
    public $timestamps = false;
    protected $table = "admins";
    public function index(){
        // Query lay du lieu
        $admins =DB::table('admins')->get();
        // Tra ve du lieu
        return $admins;
    }
    public function store(){
        // query builder uufng để lưu dữ liệu
        DB::table('admins')->insert([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password
        ]);
    }
    public function edit(){
        $admins = DB::table('admins')
            ->where('id',$this->id)
            ->get();
        return $admins;
    }
    public function updateAdmin(){
        // query builder de update du lieu
        DB::table('admins')->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'password' => $this->password
            ]);
    }
    public function destroyAdmin(){
        DB::table('admins')
            ->where('id', $this->id)
            ->delete();
    }
}
