@extends('forum.index')

@section('content')
			
@foreach ($threads as $thread)
	<div class="card card-default">				
		<div class="card-header">
			<img src="{{ $thread->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
			<span>{{ $thread->user->name }}, <b>{{ $thread->created_at->diffForHumans() }}</b></span>														
			<a href="{{ route('thread.show', ['slug' =>$thread->slug])}}" class="btn btn-secondary float-right btn-sm" style="margin-right: 8px;">View</a>
		</div>

		<div class="card-body">
			<h4 class="text-center"><b>{{ $thread->title}}</b></h4>
			<p class="text-center">{{ str_limit($thread->content, 50) }}</p>
		</div>	
		
		<div class="card-footer">
			<span>{{ $thread->replies->count() }} Replies</span>
			<a href="{{ route('channel.show', ['slug' => $thread->channel->slug]) }}" class="btn btn-secondary float-right btn-sm">{{ $thread->channel->title }}</a>
		</div>
	</div>	
	<br>
@endforeach

<div class="text-center">
	{{ $threads->links() }}	
</div>			

@endsection