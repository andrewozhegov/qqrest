<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notifies';

    protected $fillable = ['count'];

    public $timestamps = false;

    static public function notifiesToArray () {
        $notifies = [];
        $count_all = 0;
        foreach (Notify::all() as $notify) {
            $notifies[$notify->page] = $notify->count;
            $count_all += $notify->count;
        }
        $notifies['count'] = $count_all;

        return $notifies;
    }
}
