<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function board ()
    {
        return $this->hasOne('App\ProductBoard', 'product_id', 'id');
    }

    public function type () {
        return $this->belongsTo('App\ProductType', 'product_type_id', 'id');
    }

    public function orders ()
    {
        return $this->belongsToMany('App\Order', 'products_orders', 'product_id', 'order_id')->withTimestamps();;
    }
}
