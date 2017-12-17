<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Gate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function board () {
        return $this->hasOne('App\StaffBoard', 'user_id', 'id');
    }

    public function role () {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    public function reviews () {
        return $this->hasMany('App\Review', 'user_id', 'id');
    }

    public function image() {
        return 'storage/'.$this->image;
    }

    public function is_moder() {
        return Gate::allows('moder');
    }

    public function is_staff() {
        return Gate::allows('staff');
    }

    public function is_admin() {
        return Gate::allows('admin');
    }
}
