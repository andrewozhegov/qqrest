<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBoard extends Model
{
    protected $table = 'product_board';

    public function product ()
    {
        return $this->belongsTo('App\Award', 'award_id', 'id');
    }
}
