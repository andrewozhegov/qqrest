<?php

namespace App\Http\Controllers;

use App\Notify;
use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Notify::all()->where('page', '=', 'events')->first()->update(['count' => 0]);

        return view('manage.events', [
            'events' => Event::all(),
            'notifies' => Notify::notifiesToArray()
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax())
        {
            $event = Event::find($id);
            $products = $event->order->products;

            $check = '';
            $price = $event->order->price + 5000 + (500 * $event->guests);



            foreach ($products as $product) {

                $check = $check.'<p> '.$product->name.' - '.$product->price.' * '.$product->count.'</p>';
            }


            $resp = [
                'title' => $event->branch->address,
                'check' => $check,
                'price' => $price
            ];

            return $resp;
        }
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
