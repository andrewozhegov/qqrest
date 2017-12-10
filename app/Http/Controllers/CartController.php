<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Notify;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // +
    {
        //Session::flush();

        $cart = Session::get('cart');
        $cart_products = [];

        if($cart != null) {
            $keys = array_keys($cart);
            $products = Product::all();

            foreach($products as $item) {
                if(in_array($item->id, $keys)) array_push($cart_products, $item);
            }
        }

        return view('cart', [
            'cart' => $cart,
            'notifies' => Notify::notifiesToArray(),
            'products' => $cart_products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax())
        {
            $path = 'cart.'.$request->get('product_id');
            $count = Session::pull($path);
            $count_all = Session::pull('cart.count');

            if ($request->get('count') == "plus") {
                ++$count;
                ++$count_all;
            } elseif ($request->get('count') == "minus" && $count > 0) {
                --$count;
                --$count_all;
            }
            $request->session()->put($path, $count);
            $request->session()->put('cart.count', $count_all);

            $cart = Session::get('cart');
            $cart_count = 0;

            if($cart != null) {
                $keys = array_keys($cart);
                $products = Product::all();

                foreach($products as $item) {
                    if(in_array($item->id, $keys)) $cart_count += $item->price * $cart[$item->id];
                }
            }

            $request->session()->put('cart.price', $cart_count);

            $resp = [
                'product_id' => $request->get('product_id'),
                'count' => $count,
                'count_all' => Session::get('cart.count'),
                'cart_count' => $cart_count
            ];

            return $resp;
        }
        else
        {
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required'
            ]);

            $client_name = $request->get('name');
            $client_phone = $request->get('phone');

            $cart = Session::pull('cart');

            if($cart != null) {

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
            }
            $notification = Notify::all()->where('page', '=', 'orders')->first();
            $notification->update([
                'count' => ++$notification->count
            ]);

            return redirect('cart');
        }
    }
}
