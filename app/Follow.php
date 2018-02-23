<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable=['follower_id','userfollowing_id', 'blocked'];
}
