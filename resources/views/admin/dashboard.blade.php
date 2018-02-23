@extends('layouts.app')

@section('content')

<div class="col-md-12 text-center">
	<button type="button" class="btn btn-primary">
		Channels <a href="{{ route('channels.index' )}}" 
		class="badge badge-light">{{ $channels->count() }}</a>
	</button>
	
	<a class="btn btn-primary" href="{{ route('dashboard.users')}}">Users</a>
	
	
	<button type="button" class="btn btn-primary">
		Threads <a href="#" 
		class="badge badge-light">2</a>
	</button>
	<br>
	<hr>
</div>

@yield('admin')
@endsection