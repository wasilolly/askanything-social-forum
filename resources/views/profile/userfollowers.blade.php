@extends('profile.index')

@section('profile')
<div class="col-md-8">	
	<div id="userFollowers">		
		@if($user->followers())
			@foreach ($user->followers() as $follower)
				<div class="card card-default">				
					<div class="card-header">
						<img src="{{ $follower->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
						<span>{{ $follower->name }}</span>														
						@auth
						<div class="float-right">
							<follow :profile_user_id="{{ $follower->id }}"></follow>
						</div>
						@endauth
					</div>
				</div>	
				<br>
			@endforeach
		@else
			<h1 class="text-center">No Followers to see here</h1>
		@endif
	</div>
</div>
@endsection