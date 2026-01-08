<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\RoomType;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obj  = new room();
        // Goi den funtion index o trong mpdels de lay du lieu
        $rooms= $obj->index();
        // Tra ve view va gui du lieu lay dc
        return view('room.index', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $objTyperoom = new RoomType();
        $typerooms = $objTyperoom->index();

        return view('room.create', ['typerooms' => $typerooms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        //
        $obj = new Room();
        $obj->name = $request->name;
        $obj->floor = $request->floor;
        $obj->status = $request->status;
        $obj->id = $request->roomtype_id;
        //Gọi function để lưu dữ liệu lên db trong model
        $obj->store();
        //
        flash()->addSuccess('Add Successfully');
        //quay veef route hiển thị danh sách
        return Redirect::route('room.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room, Request $request)
    {
        //
        $objTyperoom = new RoomType();
        $typerooms = $objTyperoom->index();
        $objRoom = new Room();
        $objRoom->id = $request->id;
        $rooms = $objRoom->edit();

        // $floor = $obj->edit();

        //hien thi view edit voi du lieu da duoc lay
        return view('room.edit',[
            'typerooms' => $typerooms, 'rooms' => $rooms
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
        $obj = new Room();
        //Lay du lieu
        $obj->id = $request->id;
        $obj->floor = $request->floor;
        $obj->name = $request->name;
        $obj->typerooms = $request->type_name;
        $obj->status = $request->status;
        // Goi function update du lieu trong model
        $obj->updateRoom();
        //
        flash()->addSuccess('Edit Successfully');
        //Quay ve Route danh sach
        return Redirect::route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room, Request $request)
    {
        //
        $obj = new Room();
        //Lay id cua ban ghi can xoa
        $obj->id = $request->id;
        // Goi function xoa ban ghi trong model
        $obj->destroyRoom();
        //
        flash()->addSuccess('Deleted Successfully');
        return Redirect::route('room.index');
    }
}
