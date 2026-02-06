<?php

namespace App\Http\Controllers;

use App\Models\InvoiceDetailed;
use App\Http\Requests\StoreInvoiceDetailedRequest;
use App\Http\Requests\UpdateInvoiceDetailedRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $obj  = new InvoiceDetailed();
        $invoicedetails = $obj->index($id);
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
    public function edit($id)
    {
        $booking = DB::table('booking')->where('id', $id)->first();
        if (!$booking || (int) $booking->booking_status != 1) {
            return Redirect::route('booking.index');
        }

        $rooms = DB::table('room as r')
            ->leftJoin('booking as b', function ($join) {
                $join->on('r.id', '=', 'b.room_id')
                    ->whereIn('b.booking_status', [1, 2]);
            })
            ->where('r.roomtype_id', $booking->room_type_id)
            ->whereNotIn('r.status', [4, 5])
            ->whereNull('b.id')
            ->select('r.*')
            ->orderBy('r.name')
            ->get();

        return view('invoicedetail.edit', [
            'rooms' => $rooms,
            'booking' => $booking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceDetailedRequest  $request
     * @param  \App\Models\InvoiceDetailed  $invoiceDetailed
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceDetailedRequest $request)
    {
        $booking = DB::table('booking')->where('id', $request->booking_id)->first();
        if (!$booking || (int) $booking->booking_status != 1) {
            return Redirect::route('booking.index');
        }

        $room = DB::table('room')->where('id', $request->room_id)->first();
        if (!$room || (int) $room->roomtype_id != (int) $booking->room_type_id || in_array((int) $room->status, [4, 5], true)) {
            flash()->addError('Phong khong hop le hoac da duoc su dung.');
            return Redirect::route('booking.index');
        }

        $hasActiveBooking = DB::table('booking')
            ->where('room_id', $room->id)
            ->whereIn('booking_status', [1, 2])
            ->where('id', '<>', $booking->id)
            ->exists();
        if ($hasActiveBooking) {
            flash()->addError('Phong khong hop le hoac da duoc su dung.');
            return Redirect::route('booking.index');
        }

        DB::table('booking')->where('id', $booking->id)->update([
            'room_id' => $room->id,
            'booking_status' => 2,
        ]);
        DB::table('room')->where('id', $room->id)->update(['status' => 2]);

        flash()->addInfo('Da check-in va gan phong.');
        return Redirect::route('booking.index');
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
