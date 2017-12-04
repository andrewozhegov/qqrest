<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notifies';

    static public function notifiesToArray () {
        $notifies = [];

        foreach (Notify::all() as $notify) {
            $notifies[$notify->page] = $notify->count;
        }

        return $notifies;
    }
}
