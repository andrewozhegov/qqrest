<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = ['text'];

    public function user () {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
