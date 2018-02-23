<?php

namespace App;

use Storage;
use App\Followable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
	use Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'slug','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function threads(){
        return $this->hasMany('App\Thread');
    }
    
    public function replies(){
        return $this->hasMany('App\Reply');
    }
    
    public function getAvatarAttribute($avatar){
        return asset(Storage::url($avatar));
    }
}
