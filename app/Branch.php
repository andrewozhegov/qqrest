<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

    public function reservations () {
        return $this->hasMany('App\Reservation', 'branch_id', 'id');
    }

    public function events () {
        return $this->hasMany('App\Event', 'branch_id', 'id');
    }

    public function board ()
    {
        return $this->hasOne('App\BranchBoard', 'branch_id', 'id');
    }
}
