<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'count', 'price', 'image', 'text', 'product_type_id'];

    public function board ()
    {
        return $this->hasOne('App\ProductBoard', 'product_id', 'id');
    }

    public function type () {
        return $this->belongsTo('App\ProductType', 'product_type_id', 'id');
    }

    public function orders ()
    {
        return $this->belongsToMany('App\Order', 'products_orders', 'product_id', 'order_id')->withTimestamps();
    }

    public function image() {
        return 'storage/'.$this->image;
    }

    public function image_big() {
        return 'storage/'.$this->image_big;
    }
}
