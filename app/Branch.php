<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = ['name', 'address', 'image', 'img_big'];

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

    public function image() {
        return 'storage/'.$this->image;
    }

    public function img_big() {
        return 'storage/'.$this->img_big;
    }
}
