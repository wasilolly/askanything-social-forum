<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use Auth;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(){
		return view('forum.threads.index',['threads'=>Thread::latest()->paginate(4)]);
	}
	public function userQuestions(){
		$threads = Auth::user()->threads()->latest()->paginate(4);
		return view('forum.threads.index',['threads'=>$threads]);
	}
}
