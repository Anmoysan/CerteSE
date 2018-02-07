<?php

namespace App\Http\Controllers;

use App\Event;
use App\Invoice;
use App\Reserve;
use App\Http\Requests\CreateInvoiceRequest;
use App\User;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $invoices = Invoice::where('user_id', $user->id)->lastest();

        return view('users.invoices', [
            'user'      => $user,
            'invoices' => $invoices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Reserve $reserve)
    {
        $reserve = Reserve::where('id', $reserve->id)->first();

        return view('invoices.create', [
            'reserve' => $reserve
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvoiceRequest $request, Reserve $reserve)
    {
        $reserve = Reserve::where('id', $reserve->id)->first();
        $user = User::where('id', $reserve->user_id)->first();

        Reserve::create([
            'user_id'   => $reserve->user_id,
            'reserve_id'   => $reserve->id,
            'buyer' => $user->username,
            'place' => $reserve->place,
            'date' => $request->input('date'),
            'cost' => $request->input('cost'),
            'units' => $request->input('units'),
        ]);

        return redirect("/events/$reserve->event_id/reserves/$reserve->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $user = Auth::user();
        $invoice = Invoice::where('id', $invoice)->where('user_id', $user->id)->first();

        return view('users.invoices', [
            'user'      => $user,
            'invoice' => $invoice,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Muestra la factura de una reserva
     *
     * @param Reserve $reserve
     * @param Invoice $invoice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function eventinvoice(Reserve $reserve, Invoice $invoice)
    {
        $reserve = Reserve::where('id', $reserve->id)->first();
        $invoice = Invoice::where('reserve_id', $reserve->id)->where('id', $invoice)->first();

        return view('invoices.show', [
            'reserve' => $reserve,
            'invoice' => $invoice
        ]);
    }
}
