<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function check($id){
		if(Auth::user()->isThisUserFollowingMe($id) == 1){
			return["status" => "follower"];
		}
		if(Auth::user()->amIFollowingThisUser($id) == 1){
			return["status" => "following"];
		}
		
		return ["status" => 0];
	}
	
	public function follow($id){
		$resp = Auth::user()->addFollow($id);
		return $resp;
	}
	
	public function unFollow($id){
		$resp = Auth::user()->unFollow($id);
		return $resp;
	}
	
	public function showFollowers($id){
		
		$followers = Auth::user()->followers()->with('profile');
		return view(profile.followers);
	}
	
	public function showFollowings($id){
		$followers = Auth::user()->followings()->with('profile');
		return view(profile.followers);
	}
}
