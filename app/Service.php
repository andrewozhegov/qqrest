<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    public function board ()
    {
        return $this->hasOne('App\ServiceBoard', 'service_id', 'id');
    }
}
