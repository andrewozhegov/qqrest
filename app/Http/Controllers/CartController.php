<?php

namespace App\Http\Controllers;

use App\Product;
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

        //dump($cart);
        //dump($cart_products);

        return view('cart', [
            'cart' => $cart,
            'products' => $cart_products,
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
        if($request->ajax()) {

            $path = 'cart.'.$request->get('product_id');
            $count = Session::pull($path);
            $count_all = Session::pull('cart.count');

            if ($request->get('count') == "plus") {
                $request->session()->put($path, ++$count);
                $request->session()->put('cart.count', ++$count_all);
            } elseif ($request->get('count') == "minus") {
                $request->session()->put($path, --$count);
                $request->session()->put('cart.count', --$count_all);
            }

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

            //------------

            $resp = [
                'product_id' => $request->get('product_id'),
                'count' => $count,
                'count_all' => Session::get('cart.count'),
                'cart_count' => $cart_count
            ];

            return $resp;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id) // +
    {
        //
    }
}
