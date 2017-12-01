<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'awards';

    protected $fillable = ['name', 'image'];

    public function board ()
    {
        return $this->hasOne('App\AwardBoard', 'award_id', 'id');
    }

    public function image() {
        return 'storage/'.$this->image;
    }
}
