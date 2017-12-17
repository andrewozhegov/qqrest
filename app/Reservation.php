<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = ['client_name', 'client_phone', 'date_time', 'done'];

    public function branch () {
        return $this->belongsTo('App\Branch', 'branch_id', 'id');
    }


}
