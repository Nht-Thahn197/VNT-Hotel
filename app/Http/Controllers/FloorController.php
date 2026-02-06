<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FloorController extends Controller
{
    public function index()
    {
        $obj = new Floor();
        $floors = $obj->index();
        return view('floor.index', ['floors' => $floors]);
    }

    public function create()
    {
        return view('floor.create');
    }

    public function store(Request $request)
    {
        $obj = new Floor();
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->status = $request->status;
        $obj->store();
        flash()->addSuccess('Add Successfully');
        return Redirect::route('floor.index');
    }

    public function edit(Floor $floor, Request $request)
    {
        $obj = new Floor();
        $obj->id = $request->id;
        $floors = $obj->edit();
        return view('floor.edit', ['floors' => $floors]);
    }

    public function update(Request $request, Floor $floor)
    {
        $obj = new Floor();
        $obj->id = $request->id;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->status = $request->status;
        $obj->updateFloor();
        flash()->addSuccess('Edited Successfully');
        return Redirect::route('floor.index');
    }

    public function destroy(Floor $floor, Request $request)
    {
        $obj = new Floor();
        $obj->id = $request->id;
        $obj->destroyFloor();
        flash()->addSuccess('Deleted Successfully');
        return Redirect::route('floor.index');
    }
}
