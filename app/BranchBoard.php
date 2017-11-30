<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchBoard extends Model
{
    protected $table = 'brunch_board';

    public function brunch ()
    {
        return $this->belongsTo('App\Brunch', 'brunch_id', 'id');
    }
}
