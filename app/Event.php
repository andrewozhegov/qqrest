<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['date_time'];

    public function branch () {
        return $this->belongsTo('App\Branch', 'brunch_id', 'id');
    }
}
