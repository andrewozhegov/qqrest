<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;

class ProductBoard extends Model
{
    protected $table = 'product_board';

    //protected $fillable = [];

    public function product ()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    static public function products_all () {
        $products = [];

        foreach (ProductBoard::all() as $product) {
            array_push($products, $product->product);
        }

        return $products;
    }

    static public function products_ids () {
        $products = [];

        foreach (ProductBoard::products_all() as $product) {
            array_push($products, $product->id);
        }

        return $products;
    }

    static public function is_on_board ($product) {
        return in_array($product->id, self::products_ids());
    }
}
