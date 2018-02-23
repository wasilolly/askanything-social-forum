<?php

namespace App;
use App\Follow;
use App\User;

trait Followable{
	
	public function addFollow($usertofollow){
		$newfollower = Follow::create([
			'follower_id' =>$this->id,
			'userfollowing_id' => $usertofollow
		]);
		
		if($newfollower){
			return 1;
		}
		return 0;
	}
	
	public function followers(){
		$followers =array();
		$getfollowers = Follow::where('userfollowing_id', $this->id)					
					->get();
		
		foreach($getfollowers as $f):
			array_push($followers, User::find($f->follower_id));
		endforeach;
		
		return $followers;
	}
	
	public function followersCount(){
		
		$followersCount = count($this->followers());		
		return $followersCount;
	}
	
	public function followersIds(){
		return collect($this->followers())->pluck('id')->toArray();
	}	
	
	public function isThisUserFollowingMe($user_id){
		if(in_array($user_id, $this->followersIds())){
			return 1;
		}
		return 0;
	}
	
	public function followings(){
		$followings =array();
		$getfollowings = Follow::where('follower_id', $this->id)					
					->get();
		
		foreach($getfollowings as $f):
			array_push($followings, User::find($f->userfollowing_id));
		endforeach;
		
		return $followings;
	}
	
	public function followingsCount(){
		
		$followingsCount =count($this->followings());		
		return $followingsCount;
		
	}
	
	public function followingsIds(){
		return collect($this->followings())->pluck('id')->toArray();
	}
	
	public function amIFollowingThisUser($user_id){
		if(in_array($user_id, $this->followingsIds())){
			return 1;
		}
		return 0;
	}
	
	public function unFollow($userToUnfollowId){
		$unfollow = Follow::where('follower_id',$this->id)
						->where('userfollowing_id', $userToUnfollowId)
						->first();
		
			if($unfollow){
				$unfollow->delete();
				return 1;
			}
		
		return 0;
	}
	
	public function block($followerToBlock){
		$blockfollower=Follow::where('userfollowing_id', $this->id)
							->where('follower_id', $followerToBlock)
							->first();
			if($blockfollower){
				$blockfollower->blocked = 1;
				return 1;
			}
		return 0;
	}
	
	public function unblock($followerTounBlock){
		$unblockfollower=Follow::where('userfollowing_id', $this->id)
							->where('follower_id', $followerToBlock)
							->where('blocked', 1)
							->first();
			if($blockfollower){
				$blockfollower->blocked = 0;
				return 1;
			}
		return 0;
	}
		
}