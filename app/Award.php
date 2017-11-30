<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'awards';

    public function board ()
    {
        return $this->hasOne('App\AwardBoard', 'award_id', 'id');
    }
}
