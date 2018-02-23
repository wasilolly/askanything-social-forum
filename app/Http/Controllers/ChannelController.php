<?php

namespace App\Http\Controllers;

use Session;
use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function  __construct(){
		$this->middleware('admin')->except('show');
	}
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.channels.index')->with('channels', Channel::latest()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.channels.index')->with('channels', Channel::all());
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
			'title' => 'required'
		]);
		
		Channel::create([
			'title' => $request->title,
			'slug' =>str_slug($request->title)
		]);
		
		Session::flash('success', 'Channel created.');
		
		return redirect()->route('channels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $channel = Channel::where('slug', $slug)->first();
		return view('forum.threads.index',['threads'=> $channel->threads()->paginate(4)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        return view('admin.channels.edit')->with('channel', Channel::find($channel->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $channel = Channel::find($channel->id);
		
		$channel->title = $request->title;
		$channel->slug = str_slug($request->title);
		$channel->save();
		
		Session::flash('success', 'Chanel edited successfully');
		
		return redirect()->route('channels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        foreach($channel->threads as $thread){
			$thread->delete();
		}
		$channel->delete();
		Session::flash('success', 'Channel deleted');
		return redirect()->route('channels.index');
    }
}
