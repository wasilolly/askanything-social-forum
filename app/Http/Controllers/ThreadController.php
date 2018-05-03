<?php

namespace App\Http\Controllers;
use App\Channel;
use App\Thread;
use App\Reply;
use Auth;
use Session;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct(){
		$this->middleware('auth')->only(['create']);
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.threads.create')->with('channels',Channel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'channel_id' => 'required',
			'content'	=> 'required',
			'title'	=> 'required'
		]);
		
		$thread = Thread::create([
			
			'title' => $request->title,
			'content' => $request->content,
			'channel_id' => $request->channel_id,
			'user_id' => Auth::id(),
			'slug'  => str_slug($request->title)
		]);
		
		Session('success', 'Thraed created');
		
		return redirect()->route('forum');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {       
		return view('forum.threads.show', ['thread'=>Thread::where('slug', $slug)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('threads.edit', ['thread' => Thread::where('slug', $slug)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        $this->validate(request(), [
			'content' => 'required'		
		]);
		
		$t = Thread::find($thread->id);
		$t->content = request()->content;
		$t->save();
		
		Session::flash('success', 'Thread updated');
		return redirect()->route('forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
       $thread = Thread::findOrFail($thread->id);
	   foreach($thread->replies as $r){
		   $r->delete();
	   }
	   $thread->delete();
	   Session('success', 'Thread Deleted');
	   return redirect()->route('forum');
    }
}
