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
        $awards = [];

        foreach (AwardBoard::all() as $award) {
            array_push($awards, $award->award);
        }

        return $awards;
    }

    static public function awards_ids () {
        $awards = [];

        foreach (AwardBoard::award_all() as $award) {
            array_push($awards, $award->id);
        }

        return $awards;
    }

    static public function is_on_board ($award) {
        return in_array($award->id, self::awards_ids());
    }
}
