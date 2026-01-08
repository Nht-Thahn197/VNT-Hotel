<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\InvoiceDetailed;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $objInvoice  = new Invoice();
        // Goi den funtion index o trong mpdels de lay du lieu
        $invoices= $objInvoice->index();
//        $objInvoiceDetail = new InvoiceDetailed();
//        $objInvoiceDetail->id = $request->id;
//        $invoicedetaileds = $objInvoiceDetail->index();
        // Tra ve view va gui du lieu lay dc
        return view('invoice.index', ['invoices' => $invoices]);

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
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
    public function updateStatus($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice->status == 0) {
            $invoice->update(['status' => 1]);
        } else {
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function mini($id)
    {
        $invoice = invoice::find($id);

        if ($invoice->status == 1) {
            $invoice->update(['status' => 2]);
        }

        return redirect()->back();
    }
    public function restore($id)
    {
        $invoice = invoice::find($id);
        if ($invoice->status == 2) {
            $invoice->update(['status' => 3]);
        }
        return redirect()->back();
    }
}
