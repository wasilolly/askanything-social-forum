@extends('admin.dashboard')

@section('admin')

<div class="col-md-4">

</div>

<div class="col-md-8">
	<table class="table">					
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Admin Priviledge</th>
				<th>Delete</th>						
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
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
</div>

       
@endsection
