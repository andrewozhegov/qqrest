<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['title', 'image', 'text'];

    public function board ()
    {
        return $this->hasOne('App\ServiceBoard', 'service_id', 'id');
    }

    public function image() {
        return 'storage/'.$this->image;
    }
}
