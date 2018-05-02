@extends('layouts.app')

@section('content')

<div class="col-md-12 text-center">
	<a href="{{ route('profile.threads', ['slug'=>$user->slug] )}}" class="btn btn-primary">
		Threads <span class="badge badge-light">{{ $user->threads->count() }}</span>
	</a>
		
	<a href="{{ route('profile.followers', ['slug'=>$user->slug] )}}"  class="btn btn-primary">
		Followers <span class="badge badge-light">{{ $user->followersCount() }}</span>
	</a>
	
    <a href="{{ route('profile.followings', ['slug'=>$user->slug] )}}" class="btn btn-primary">
		Following <span class="badge badge-light">{{ $user->followingsCount() }}</span>
	</a>	
	<br>
	<hr>
</div>

<div class="col-md-3">
	<div class="card card-default">
		<div class="card-header text-center">{{ $user->name }}'s Profile</div>
		<div class="card-body">			
			<center>
				<img src="{{ $user->avatar }}" width="140px" height="140px" style="border-radius: 50%;" alt="">	
			</center>
			<br>
			
			<p class="text-center">
				@if(Auth::id() == $user->id)
					<a href="{{ route('profile.edit') }}" class="btn btn-secondary">Edit your Profile</a>
				@endif										
				<br>
				<strong>Location: </strong> <small><b>{{ $user->profile->location }}</b></small>
			</p>
		</div>		
	</div>
    @auth	
	@if(Auth::id() != $user->id)		
		<hr>
		<div class="card card-default">		
			<div class="card-body">
				<follow :profile_user_id="{{ $user->id }}"></follow>
			</div>	
		</div>
	@endif
	@endauth
	<hr>	
	<div class="card card-default">
		<div class="card-header text-center"><b>About me</b></div>
		<div class="card-body text-center">
			{{ $user->profile->about }}
		</div>		
	</div>
</div>

	@yield('profile')

@endsection