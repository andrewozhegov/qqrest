<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Event;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

use App\Notify;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    public function show()
    {
        return view('event', [
            'branches' => Branch::all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    public function reserve(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guests' => 'required',
            'address' => 'required',
            'date' => 'required',
            'time' => 'required',
            'phone' => 'required'
        ]);

        $client_name = $request->get('name');
        $client_phone = $request->get('phone');

        $cart = Session::pull('cart');

        if($cart != null)
        {
            $event = Event::create([
                'date_time' => $request->get('date').' '.$request->get('time'),
                'guests' => (int)$request->get('guests'),
            ]);

            Branch::find($request->get('address'))->events()->save($event);

            $cart_count = 0;
            if($cart != null) {
                $keys = array_keys($cart);
                $products = Product::all();

                foreach($products as $item) {
                    if(in_array($item->id, $keys)) $cart_count += $item->price * $cart[$item->id];
                }
            }

            $order = Order::create([
                'client_name' => $client_name,
                'client_phone'=> $client_phone,
                'price' => $cart_count
            ]);

            $keys = array_keys($cart);
            $products = Product::all();

            foreach($products as $item) {
                if(in_array($item->id, $keys)) {
                    $order->products()->save($item, ['count' => $cart[$item->id]]);
                }
            }
            $event->order()->associate($order);
            $event->save();

            $notification = Notify::all()->where('page', '=', 'orders')->first();
            $notification->update([
                'count' => ++$notification->count
            ]);

            $notification = Notify::all()->where('page', '=', 'events')->first();
            $notification->update([
                'count' => ++$notification->count
            ]);
        }

        return redirect('event');
    }
}
