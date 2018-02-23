@extends('forum.index')

@section('content')
	<div class="card card-default">
		<div class="card-header text-center">Ask away......</div>

		<div class="card-body">
			<form action="{{ route('threads.store')}}" method="POST">
				{{ csrf_field() }}
			
				<div class="form-group">
					<label for="channel">Choose a Channel</label>
					<select name="channel_id" class="form-control">
						@foreach($channels as $channel)
							<option value="{{ $channel->id }}">{{ $channel->title }}</option>				
						@endforeach
					</select>
				</div>
				
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" value="{{ old('title')}}" class="form-control">							
				</div>
				
				<div class="form-group">
					<label for="content">Ask a Question</label>
					<textarea name="content" id="content" cols="10" rows="10" class="form-control">{{ old('content') }}</textarea>							
				</div>
				
				<div class="form-group">
					<button class="btn btn-success pull-right" type="submit">Create Discussion</button>				
				</div>
				
			</form>
		</div>
	</div>
	
@endsection
