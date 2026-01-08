<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obj  = new Admin();
        // Goi den funtion index o trong mpdels de lay du lieu
        $admins = $obj->index();
        // Tra ve view va gui du lieu lay dc
        return view('admin.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //Tạo đối tượng mới
        $obj = new Admin();
        //Lấy dữ liệu
        $obj->name = $request->name;
        $obj->phone = $request->phone;
        $obj->email = $request->email;
        $obj->password = $request->password;
        //Gọi function để lưu dữ liệu lên db trong model
        $array = array();
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'phone', $request->phone);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'password', bcrypt($request->password));

        Admin::create($array);
        //Notification
        flash()->addSuccess('Add Successfully');

        //quay veef route hiển thị danh sách
        return Redirect::route('admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin, Request $request )
    {
        // lay du lieu tren id
        $obj = new Admin();
        $obj->id = $request->id;
        $admins = $obj->edit();

        //hien thi view edit voi du lieu da duoc lay
        return view('admin.edit',[
            'admins' => $admins
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //Tao doi tuong moi
        $obj = new Admin();
        //Lay du lieu
        $obj->id = $request->id;
        $obj->name = $request->name;
        $obj->phone = $request->phone;
        $obj->email = $request->email;
        $obj->password = $request->password;
        // Goi function update du lieu trong model
        $obj->updateAdmin();
        //
        flash()->addSuccess('Edited Successfully');
        //Quay ve Route danh sach
        return Redirect::route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin, Request $request)
    {
        //Tao doi tuong
        $obj = new Admin();
        //Lay id cua ban ghi can xoa
        $obj->id = $request->id;
        // Goi function xoa ban ghi trong model
        $obj->destroyAdmin();
        //
        flash()->addSuccess('Deleted Successfully');
        return Redirect::route('admin.index');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function login()
    {
        return view('admin.login');
    }

    public function loginProcess(Request $request)
    {
        // Lấy email và password
        $accountAdmin = $request->only(['email', 'password']);
        // Xác thực xem email và password này có thực sự tồn tại không
        if (Auth::guard('admin')->attempt($accountAdmin)){
            // Lấy thông tin

            $admin = Auth::guard('admin')->user();
            // Tiến Hành login
            Auth::login($admin);
            // Lưu dữ liệu customer đang login
            session(['admin'=> $admin]);
            // Chuyển sang trang chủ
            flash()->addSuccess('Logged in Successfully');
            return Redirect::route('dashboard');
        }else{
            // Quay về form login
            flash()->addError('Login Failed, Please check your account or password again');
            return Redirect::back();
        }
    }
}
