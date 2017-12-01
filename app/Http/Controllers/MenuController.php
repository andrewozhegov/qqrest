<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductBoard;

class MenuController extends Controller
{
    public function show()
    {
        return view('menu', [
            'products' => Product::all(),
            'board' => ProductBoard::product_all()
        ]);
    }

    public function add(Request $request)
    {
        if($request->ajax()) {
            return '+++';
        }
    }
}
