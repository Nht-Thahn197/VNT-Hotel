<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obj  = new customer();
        // Goi den funtion index o trong mpdels de lay du lieu
        $customers = $obj->index();
        // Tra ve view va gui du lieu lay dc
        return view('customer.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Gọi đến view create
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        //Tạo đối tượng mới
        $obj = new Customer();
        //Lấy dữ liệu
        $obj->name = $request->name;
        $obj->phone = $request->phone;
        $obj->email = $request->email;
        $obj->address = $request->address;
        if ($request->filled('password')) {
            $obj->password = bcrypt($request->password);
        } else {
            $obj->password = DB::table('customer')->where('id', $request->id)->value('password');
        }
        $obj->id_card = $request->id_card;
        //Gọi function để lưu dữ liệu lên db trong model
        $array = array();
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'phone', $request->phone);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'password', bcrypt($request->password));
        $array = Arr::add($array, 'id_card', $request->id_card);

        Customer::create($array);
        //
        flash()->addSuccess('Add Successfully');
        //quay veef route hiển thị danh sách
        return Redirect::route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer, Request $request)
    {
        // lay du lieu tren id
        $obj = new Customer();
        $obj->id = $request->id;
        $customers = $obj->edit();

        //hien thi view edit voi du lieu da duoc lay
        return view('customer.edit',[
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //Tao doi tuong moi
        $obj = new Customer();
        //Lay du lieu
        $obj->id = $request->id;
        $obj->name = $request->name;
        $obj->phone = $request->phone;
        $obj->email = $request->email;
        $obj->address = $request->address;
        $obj->password = $request->password;
        $obj->id_card = $request->id_card;
        // Goi function update du lieu trong model
        $obj->updateCustomer();
        //
        flash()->addSuccess('Edited Successfully');
        //Quay ve Route danh sach
        return Redirect::route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer, Request $request)
    {
        //Tao doi tuong
        $obj = new Customer();
        //Lay id cua ban ghi can xoa
        $obj->id = $request->id;
        // Goi function xoa ban ghi trong model
        $obj->destroyCustomer();
        //
        flash()->addSuccess('Deleted Successfully');
        //
        return Redirect::route('customer.index');
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

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->forget('customer');
        return Redirect::route('home.index');
    }
    public function cancel($id)
    {
        $booking = \App\Models\Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        if (in_array($booking->booking_status, [0, 1], true)) {
            $booking->booking_status = 4;
            $booking->save();
            return redirect()->back()->with('success', 'Da huy booking thanh cong.');
        }

        return redirect()->back()->with('error', 'Khong the huy booking voi trang thai hien tai.');
    }
}
