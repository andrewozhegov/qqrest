<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Award;

class AwardBoard extends Model
{
    protected $table = 'award_board';

    //protected $fillable = [];

    public function award ()
    {
        return $this->belongsTo('App\Award', 'award_id', 'id');
    }

    static public function award_all () {
        $award = [];
        array_push ($award,
            AwardBoard::find(1)->award,
            AwardBoard::find(2)->award,
            AwardBoard::find(3)->award
        );
        return $award;
    }
}
