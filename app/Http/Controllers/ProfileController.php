<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Thread;
use Auth;
use Session;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($slug)
    {
        $user=User::where('slug',$slug)->first();
		return view('profile.index')->with('user', $user);
    }

    public function edit()
    {
        return view('profile.edit')->with('profile', Auth::user()->profile);
    }

     public function update(Request $request)
    {
        $this->validate($request,[
			'about' => 'required|max:255',
			'location' => 'required'		
		]);
		
		Auth::user()->profile()->update([
			'about' => $request->about,
			'location' => $request->location
		]);
		
		if($request->hasFile('avatar')){
			Auth::user()->update([
				'avatar' => $request->avatar->store('public/avatars')
			]);
		}
		Session::flash('success', 'Profile Updated');
		return redirect()->route('profile',['slug'=> Auth::user()->slug]);
    }
	
	public function profileThreads($slug){		
		return view('profile.userthreads',['user'=>User::where('slug',$slug)->first()]);
	}
	public function profileFollowers($slug){		
		return view('profile.userfollowers',['user'=>User::where('slug',$slug)->first()]);
	}
	public function profileFollowings($slug){		
		return view('profile.userfollowings',['user'=>User::where('slug',$slug)->first()]);
	}
}
