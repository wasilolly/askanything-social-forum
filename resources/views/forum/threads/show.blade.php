@extends('forum.index')

@section('content')
   
<div class="card card-default">				
	<div class="card-header">
		<img src="{{ $thread->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
		<span>{{ $thread->user->name }}, <b>({{ $thread->user->points }})</b></span>	
		
		
	</div>

	<div class="card-body">
		<h4 class="text-center">
			<b>{{ $thread->title}}</b>
		</h4>
		
		<hr>
		
		<p class="text-center">
			{{ ($thread->content) }}					
		</p>
		
	</div>	
</div>
<br>
@foreach($thread->replies as $r)
	<div class="card card-default">				
		<div class="card-header">
			<img src="{{ $r->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
			<span>{{ $r->user->name }} <b>( {{ $r->user->points }} )</b></span>
			
		</div>
		
		<div class="card-body">				
			<p class="text-center">
				{{ ($r->content) }}					
			</p>
		</div>
		
		
	</div>
	<br>
	
@endforeach 


<div class="card card-default">
	<div class="card-body">
		@if(Auth::check())
			<form action="{{ route('thread.reply', ['id'=>$thread->id]) }}" method="POST">
					{{ csrf_field() }}
				<div class="form-group">
					<label for="reply">Reply....</label>
					<textarea name="reply" id="reply" rows="10" cols="30" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<button class="btn pull-right">Reply</button>
				</div>
			</form>
		@else	
			<div class="text-center">
				<h2>Sign in to leave a reply</h2>
			</div>
		@endif
	</div>
</div>

@endsection
