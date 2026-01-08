<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Tao doi tuong cua model
        $obj  = new service();
        // Goi den funtion index o trong mpdels de lay du lieu
        $services = $obj->index();
        // Tra ve view va gui du lieu lay dc
        return view('service.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        //
        $obj = new Service();
        //Lấy dữ liệu
        $obj->name = $request->name;
        $obj->image = $request->image;
        $obj->price = $request->price;
        $obj->describe = $request->describe;
        //Gọi function để lưu dữ liệu lên db trong model
        $obj->store();
        // Notification
        flash()->addSuccess('Add Successfully');
        //quay veef route hiển thị danh sách
        return Redirect::route('service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service, Request $request)
    {
        //
        $obj = new Service();
        $obj->id = $request->id;
        $services = $obj->edit();

        //hien thi view edit voi du lieu da duoc lay
        return view('service.edit',[
            'services' => $services
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        //
        $obj = new Service();
        //Lay du lieu
        $obj->id = $request->id;
        $obj->name = $request->name;
        $obj->image = $request->image;
        $obj->price = $request->price;
        $obj->describe = $request->describe;
        // Goi function update du lieu trong model
        $obj->updateService();
        flash()->addSuccess('Edited Successfully');
        //Quay ve Route danh sach
        return Redirect::route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service, Request $request)
    {
        //
        $obj = new Service();
        //Lay id cua ban ghi can xoa
        $obj->id = $request->id;
        // Goi function xoa ban ghi trong model
        $obj->destroyService();
        flash()->addSuccess('Deleted Successfully');
        return Redirect::route('service.index');
    }
}
