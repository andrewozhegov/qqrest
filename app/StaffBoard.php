<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffBoard extends Model
{
    protected $table = 'staff_board';

    //protected $fillable = [];

    public function user ()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    static public function staff_all () {
        $staff = [];
        array_push ($staff,
            StaffBoard::find(1)->user,
            StaffBoard::find(2)->user,
            StaffBoard::find(3)->user
        );
        return $staff;
    }
}
