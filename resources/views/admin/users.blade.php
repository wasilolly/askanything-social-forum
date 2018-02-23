@extends('layouts.app')

@section('content')

<table id="myTable">					
	<thead>
		<tr>
			<th>Name</th>
			<th>Location</th>
			<th>Email</th>
			<th>Followers</th>
			<th>Threads</th>
			<th>Replies</th>
			<th>Admin Priviledge</th>
			<th>Delete</th>						
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
			<tr>
				<td><a href="{{ route('profile', ['slug'=>$user->slug])}}">{{ $user->name }}</a></td>
				<td>{{ $user->profile->location }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->followersCount() }}</td>
				<td>{{ $user->threads->count() }}</td>
				<td>{{ $user->replies->count() }}</td>
				@if($user->admin)
					<td><a href="{{ route('user.revoke', ['id'=>$user->id]) }}">Revoke</a></td>
				@else
					<td><a href="{{ route('user.admin', ['id'=>$user->id]) }}">Admin</a></td>
				@endif
				<td>
					<form action="{{ route('user.delete', ['id'=>$user->id])}}" method="POST"
						onsubmit="return confirm('Both user account and profile will be deleted. Are you sure?')">
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
	{{$users->links() }}
</div>    
@endsection

@section('javascript')
	$(document).ready(function()
	{
		$('#myTable').DataTable();
	});
@endsection
