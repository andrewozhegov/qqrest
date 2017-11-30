<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    public function branch () {
        return $this->belongsTo('App\Branch', 'brunch_id', 'id');
    }
}
