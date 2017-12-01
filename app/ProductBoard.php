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

    static public function product_all () {
        $product = [];
        array_push ($product,
            ProductBoard::find(1)->product,
            ProductBoard::find(2)->product,
            ProductBoard::find(3)->product
        );
        return $product;
    }
}
