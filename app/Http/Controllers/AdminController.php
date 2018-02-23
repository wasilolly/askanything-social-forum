<?php

namespace App\Http\Controllers;

use Session;
use App\Thread;
use App\User;
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
		$user->profile->delete();
		$user->delete();
		return redirect()->back();
	}
}
