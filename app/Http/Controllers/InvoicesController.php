<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        $invoices = $user->invoices;

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
    public function create(Event $event, Reserve $reserve)
    {
        $event = Event::where('id', $event->id)->first();
        $reserves = $event->reserves;
        $posicion = 0;

        foreach ($reserves as $indice=>$reserv) {
            if ($reserv->id == $reserve->id) {
                $reserve = $reserv;
                $posicion = $indice;
            }
        }

        return view('invoices.create', [
            'event' => $event,
            'reserve' => $reserve,
            'posicion' => $posicion
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvoiceRequest $request, Event $event, Reserve $reserve)
    {
        $reserve = Reserve::where('id', $reserve->id)->first();
        $user = Auth::user();

        Reserve::create([
            'user_id'   => $user->id,
            'reserve_id'   => $reserve->id,
            'buyer' => $request->input('units'),
            'place' => $reserve->place,
            'date' => $reserve->date,
            'cost' => $reserve->cost,
            'units' => $reserve->units
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
        $invoices = $user->invoices;

        foreach ($invoices as $indice=>$invoic) {
            if ($invoic->id == $invoice->id) {
                $invoice = $invoic;
            }
        }

        return view('users.invoices', [
            'user'      => $user,
            'invoice' => $invoice
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
}
