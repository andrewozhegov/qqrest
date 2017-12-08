<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['price', 'done', 'client_name', 'client_phone'];

    public function events () {
        return $this->hasMany('App\Event', 'order_id', 'id');
    }

    public function products ()
    {
        return $this->belongsToMany('App\Product', 'products_orders', 'order_id', 'product_id');
    }
}
