<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardBoard extends Model
{
    protected $table = 'award_board';

    public function award ()
    {
        return $this->belongsTo('App\Award', 'award_id', 'id');
    }
}
