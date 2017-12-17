<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

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
        if (Gate::denies('staff')) {
            return redirect('/');
        }

        Notify::all()->where('page', '=', 'events')->first()->update(['count' => 0]);

        return view('manage.events', [
            'events' => Event::all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (Gate::denies('staff')) {
            return redirect('/');
        }

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
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if (Gate::denies('staff')) {
            return redirect('/');
        }

        $event = Event::find($id);

        $event->update([
            'done' => 1
        ]);

        return $event->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Gate::denies('staff')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $event = Event::find($id);
            $order = $event->order;
            $order->products()->detach();
            $event->delete();
            $order->delete();
        }
    }
}
