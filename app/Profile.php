<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=['about','location','user_id'];
	
	public function user(){
		return $this->belongsTo('App\User');
	}
}
