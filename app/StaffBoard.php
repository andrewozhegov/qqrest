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
        $staffs = [];

        foreach (StaffBoard::all() as $staff) {
            array_push($staffs, $staff->user);
        }

        return $staffs;
    }

    static public function staff_ids () {
        $staffs = [];

        foreach (StaffBoard::staff_all() as $staff) {
            array_push($staffs, $staff->id);
        }

        return $staffs;
    }

    static public function is_on_board ($staff) {
        return in_array($staff->id, self::staff_ids());
    }
}
