<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notify;

use App\Product;
use App\ProductBoard;

class MenuController extends Controller
{
    public function show()
    {
        return view('menu', [
            'products' => Product::all(),
            'board' => ProductBoard::products_all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    public function add(Request $request)
    {
        if($request->ajax()) {
            // вот тут будет обработчик добавления заказа
            return '+++';
        }
    }
}
