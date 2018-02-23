@extends('admin.dashboard')

@section('admin')

<div class="col-md-4">
	<form action="{{ route('channels.store') }}" method="POST" >
		{{ csrf_field() }}
	
		<div class="form-group">
			<input type="text" name="title" class="form-control" placeholder="New Channel">
		</div>
		<div class="form-group">
			<div class="text-center">
				<button class="btn btn-success" type="submit">Save</button>
			</div>					
		</div>			
	</form>			
</div>


<div class="col-md-8">
	<table class="table">					
		<thead>
			<tr>
				<th>Title</th>
				<th>Edit</th>
				<th>Delete</th>						
			</tr>
		</thead>
		<tbody>
			@foreach($channels as $channel)
				<tr>
					<td>{{ $channel->title }}</td>
					
					<td>
						<a href="{{ route('channels.edit', ['channel' => $channel]) }}" class= "btn btn-xs btn-primary">Edit</a>
					</td>
					
					<td>
						<form action="{{ route('channels.destroy', ['channel' => $channel->id]) }}" method="POST"
							onsubmit="return confirm('All threads under this channel will be deleted. Are you sure?')">
									{{ csrf_field() }}
									{{ method_field('DELETE')}}
									
							<button class= "btn btn-xs btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<br>
	<div class="text-center float-right">
		{{$channels->links() }}
	</div>
</div>

       
@endsection
