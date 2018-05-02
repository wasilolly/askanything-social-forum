<?php

namespace App\Http\Controllers;

use Session;
use App\Thread;
use App\User;
use App\Follow;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	
	public function users(){
		return view('admin.users',['users'=>User::latest()->Paginate(4)]);
	}
	
	
	public function admin($id){
		$user = User::find($id);
		$user->admin = 1;
		
		$user->save();
		
		Session::flash('success', 'Admin priviledge granted');
		return redirect()->back();
	}
	
	public function revokeAdmin($id){
		$user = User::find($id);
		$user->admin = 0;
		
		$user->save();
		
		Session::flash('success', 'Admin Priviledge revoked');
		return redirect()->back();
	}
	
	public function userDelete($id){
		$user=User::findOrFail($id);
		foreach($user->threads as $thread){
			$thread->delete();
		}
		foreach($user->replies as $reply){
			$reply->delete();
		}
		foreach($user->followersIds() as $follower){
			$followings=Follow::where('userfollowing_id',$id)->first();
			$followings->delete();
		}
		foreach($user->followingsIds() as $following){
			$follower=Follow::where('follower_id',$id)->get();
			$follower->delete();
		}
		
		$user->profile->delete();
		$user->delete();
		
		Session::flash('success', 'User Deleted');
		return redirect()->back();
	}
}
