<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchBoard extends Model
{
    protected $table = 'branch_board';

    //protected $fillable = [];

    public function branch ()
    {
        return $this->belongsTo('App\Branch', 'branch_id', 'id');
    }

    static public function branch_all () {
        $branches = [];
        array_push ($branches,
            BranchBoard::find(1)->branch,
            BranchBoard::find(2)->branch,
            BranchBoard::find(3)->branch
        );
        return $branches;
    }
}
