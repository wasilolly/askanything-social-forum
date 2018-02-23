<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title', 'slug'];
	
	public function threads(){
		return $this->hasMany('App\Thread');
	}
}
