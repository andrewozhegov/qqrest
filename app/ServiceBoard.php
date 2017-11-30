<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceBoard extends Model
{
    protected $table = 'service_board';

    public function service ()
    {
        return $this->belongsTo('App\Service', 'service_id', 'id');
    }
}
