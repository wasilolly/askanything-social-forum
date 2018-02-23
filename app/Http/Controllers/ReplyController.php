<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use App\User;
use Session;
use Auth;
use App\Notifications\newReply;
use Illuminate\Notifications\Notification;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
		$thread = Thread::findOrFail($id);
		
		$this->validate($request,[
			'reply'=>'required'
		]);
		
		$reply = Reply::create([
			'user_id' => Auth::id(),
			'thread_id' => $id,
			'content' => $request->reply
		]);
		
		$reply->user->points += 15;
		$reply->user->save();
		
		$threadCreator = User::findOrFail($thread->user_id);		
		$threadCreator->notify(new newReply($thread));
		
		Session::flash('success', 'Replied successfully');
		return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
