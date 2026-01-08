<?php

namespace App\Http\Controllers;

use App\Models\InvoiceDetailed;
use App\Http\Requests\StoreInvoiceDetailedRequest;
use App\Http\Requests\UpdateInvoiceDetailedRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InvoiceDetailedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $obj  = new InvoiceDetailed();
        // Goi den funtion index o trong mpdels de lay du lieu
        $invoicedetails= $obj->index($id);
        // Tra ve view va gui du lieu lay dc
        return view('invoicedetail.index', ['invoicedetails' => $invoicedetails]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceDetailedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceDetailedRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceDetailed  $invoiceDetailed
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceDetailed $invoiceDetailed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceDetailed  $invoiceDetailed
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceDetailed $invoiceDetailed, Request $request)
    {
        //
        $objRoom = new Room();
        $rooms = $objRoom->index();
        $objInvoicedetail = new InvoiceDetailed();
        $objInvoicedetail->id = $request->id;
        $invoicedetails = $objInvoicedetail->edit();

        // $floor = $obj->edit();

        //hien thi view edit voi du lieu da duoc lay
        return view('invoicedetail.edit',['rooms' => $rooms, 'invoicedetails' => $invoicedetails
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceDetailedRequest  $request
     * @param  \App\Models\InvoiceDetailed  $invoiceDetailed
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceDetailedRequest $request, InvoiceDetailed $invoiceDetailed)
    {
        //
        $obj = new InvoiceDetailed();
        $obj->room_id= $request->room_name;

        $obj->invoice_id= $request->invoice_id;
        //Lay du lieu
        // Goi function update du lieu trong model
        $obj->updateInvoicedetail();
        //
        flash()->addInfo('Guest room selected. Please press "Detail" to check');
        //Quay ve Route danh sach
        return Redirect::route('invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceDetailed  $invoiceDetailed
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceDetailed $invoiceDetailed)
    {
        //
    }
}
