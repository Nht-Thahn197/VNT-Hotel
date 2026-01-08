<?php

namespace App\Http\Controllers;

use App\Models\ServiceInvoice;
use App\Http\Requests\StoreServiceInvoiceRequest;
use App\Http\Requests\UpdateServiceInvoiceRequest;

class ServiceInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obj  = new ServiceInvoice();
        // Goi den funtion index o trong mpdels de lay du lieu
        $serviceinvoices = $obj->index();
        // Tra ve view va gui du lieu lay dc
        return view('serviceinvoice.index', ['serviceinvoices' => $serviceinvoices]);
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
     * @param  \App\Http\Requests\StoreServiceInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceInvoice $serviceInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceInvoice $serviceInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceInvoiceRequest  $request
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceInvoiceRequest $request, ServiceInvoice $serviceInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceInvoice $serviceInvoice)
    {
        //
    }
}
