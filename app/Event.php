<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['date_time', 'done', 'guests'];

    public function branch () {
        return $this->belongsTo('App\Branch', 'branch_id', 'id');
    }

    public function order () {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
}
