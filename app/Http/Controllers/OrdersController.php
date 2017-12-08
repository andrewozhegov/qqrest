<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Notify;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.orders', [
            'orders' => Order::all(),
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
            $order = Order::find($id);
            $products = $order->products;

            $check = '';

            foreach ($products as $product) {
                $check = $check.'<p> '.$product->name.' - '.$product->price.' * '.$product->count.'</p>';
            }

            $resp = [
                'check' => $check,
                'price' => $order->price
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $order = Order::find($id);

        $order->update([
            'done' => 1
        ]);

        return $order->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax())
        {
            $order = Order::find($id);
            $order->products()->detach();
            $order->delete();
        }
    }
}
