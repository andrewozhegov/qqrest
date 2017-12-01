<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceBoard extends Model
{
    protected $table = 'service_board';

    //protected $fillable = [];

    public function service ()
    {
        return $this->belongsTo('App\Service', 'service_id', 'id');
    }

    static public function service_all () {
        $services = [];
        array_push ($services,
            ServiceBoard::find(1)->service,
            ServiceBoard::find(2)->service,
            ServiceBoard::find(3)->service
        );
        return $services;
    }
}
