<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Order;
use App\Notify;
use App\ProductsOrder;

class OrdersController extends Controller
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

        Notify::all()->where('page', '=', 'orders')->first()->update(['count' => 0]);

        return view('manage.orders', [
            'orders' => Order::all(),
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
            $order = Order::find($id);
            $products = $order->products;

            $check = '';

            foreach ($products as $product) {
                $check = $check.'<p> '.$product->name.' - '.$product->price.' * '.ProductsOrder::count($id, $product->id).'</p>';
            }

            $resp = [
                'check' => $check,
                'price' => $order->price
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
        if (Gate::denies('staff')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $order = Order::find($id);
            $order->products()->detach();
            $order->delete();
        }
    }
}
