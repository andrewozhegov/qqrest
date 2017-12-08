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

        foreach (BranchBoard::all() as $branch) {
            array_push($branches, $branch->branch);
        }

        return $branches;
    }

    static public function branch_ids () {
        $branches = [];

        foreach (BranchBoard::branch_all() as $branch) {
            array_push($branches, $branch->id);
        }

        return $branches;
    }

    static public function is_on_board ($branch) {
        return in_array($branch->id, self::branch_ids());
    }
}
