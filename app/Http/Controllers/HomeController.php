<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHomeRequest;
use App\Models\Customer;
use App\Models\Home;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    //
    public function index(){
        $obj = new Home();
        $homes = $obj->index();

        $obj = new RoomType();
        $typerooms = $obj->index();
        $obj  = new Customer();
        // Goi den funtion index o trong mpdels de lay du lieu
        $customers = $obj->show();
        return view('home.index', ['homes'=>$homes,
            'typerooms'=>$typerooms,
            'customers' =>$customers
        ]);
    }


    public function store(Request $request)
    {
        //
        $obj = new Home();
        $obj->roomtype_id = $request->roomtype_id;
        $formatted_start = str_replace('T', ' ', $request->check_in) . ':00';
        $obj->time_start = strtotime($formatted_start);
        $formatted_end = str_replace('T', ' ', $request->check_out) . ':00';
        $obj->time_end = strtotime($formatted_end);
        $obj->people = $request->people;
        $obj->method = $request->paymentmethod;
        //Gọi function để lưu dữ liệu lên db trong model
        $obj->store();
        //
        flash()->addSuccess('Booking has been successful. Please go to "My Booking" to check');
        //quay veef route hiển thị danh sách
        return Redirect::route('home.index');
    }
    
    public function show($customer_id){
        $obj = new Home();
        $orders = $obj->show($customer_id);
        return view('home.booking', [
            'orders' => $orders,
        ]);
    }
    public function login()
    {
        return view('customer.login');
    }

    public function loginProcess(Request $request)
    {
        // Lấy email và password
        $accountCustomer = $request->only(['email', 'password']);
        // Xác thực xem email và password này có thực sự tồn tại không
        if (Auth::guard('customer')->attempt($accountCustomer)){
            // Lấy thông tin

            $customer = Auth::guard('customer')->user();
            // Tiến Hành login
            Auth::login($customer);
            // Lưu dữ liệu customer đang login
            session(['customer'=> $customer]);
            //
            flash()->addSuccess('Logged in Successfully');
            // Chuyển sang trang chủ
            return Redirect::route('home.index');
        }else{
            //
            flash()->addError('Login Failed, Please check your account or password again');
            // Quay về form login
            return Redirect::back();
        }
    }
}
