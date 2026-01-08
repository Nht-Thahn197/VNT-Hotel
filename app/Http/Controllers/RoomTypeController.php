<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obj  = new RoomType();
        // Goi den funtion index o trong mpdels de lay du lieu
        $typerooms = $obj->index();
        // Tra ve view va gui du lieu lay dc
        return view('typeroom.index', ['typerooms' => $typerooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('typeroom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomTypeRequest $request)
    {
        //
        $obj = new RoomType();
        //Lấy dữ liệu
        $obj->name = $request->name;
        $obj->price = $request->price;
        $obj->guest = $request->guest;
        //Gọi function để lưu dữ liệu lên db trong model
        $obj->store();
        //quay veef route hiển thị danh sách
        return Redirect::route('typeroom.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType, Request $request)
    {
        //
        $obj = new RoomType();
        $obj->id = $request->id;
        $typerooms = $obj->edit();

        //hien thi view edit voi du lieu da duoc lay
        return view('typeroom.edit',[
            'typerooms' => $typerooms
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomTypeRequest  $request
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        //
        //Tao doi tuong moi
        $obj = new RoomType();
        //Lay du lieu
        $obj->id = $request->id;
        $obj->name = $request->name;
        $obj->price = $request->price;
        $obj->guest = $request->guest;
        // Goi function update du lieu trong model
        $obj->updateTyperoom();
        //Quay ve Route danh sach
        return Redirect::route('typeroom.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $roomType, Request $request)
    {
        //Tao doi tuong
        $obj = new RoomType();
        //Lay id cua ban ghi can xoa
        $obj->id = $request->id;
        // Goi function xoa ban ghi trong model
        $obj->destroyTyperoom();
        return Redirect::route('typeroom.index');
    }
}
