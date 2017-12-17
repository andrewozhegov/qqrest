<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsOrder extends Model
{
    protected $table = 'products_orders';

    protected $fillable = ['count'];

    static public function count($order_id, $product_id) {
        return ProductsOrder::all()->where('order_id', '=', $order_id)->where('product_id', '=', $product_id)->first()->count;
    }
}
