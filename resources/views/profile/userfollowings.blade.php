@extends('profile.index')

@section('profile')
<div class="col-md-8">
	<div id="userFollowings">
		@if($user->followings())
			@foreach ($user->followings() as $following)
				<div class="card card-default">				
					<div class="card-body">
						<img src="{{ $following->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
						<span>{{ $following->name }}</span>
						<div class="float-right">
							<follow :profile_user_id="{{ $following->id }}"></follow>
						</div>
					</div>
				</div>			
				<br>
			@endforeach
		@else
			<h1 class="text-center">No Followings to see here</h1>
		@endif
	</div>
</div>
@endsection