<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = ['title', 'image', 'text'];

    public function image() {
        return 'storage/'.$this->image;
    }

}
