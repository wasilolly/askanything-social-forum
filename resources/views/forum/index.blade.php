<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AskAnything') }}</title>

    <!-- Styles -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
        
	@include('layouts.nav')	
	
	<br>
	
	<div class="container">	
		<div class="row">
			<div class="col-md-4">
				@auth
					<a href="{{ route('threads.create') }}" class="btn btn-secondary form-control">Ask a Question</a>
					<br>
					<br>				
					<a href="{{ route('user.questions') }}" class="btn btn-secondary form-control">My Questions</a>
					@if(Auth::user()->admin)
						<br>
						<br>
						<a href="{{ route('channels.index') }}" class="btn btn-secondary form-control">Channels Settings</a>
					@endif
					<br>
					<br>
				@endauth
				
				<div class="card card-default">	
					<div class="card-header">Channels</div>
					<div class="card-body">
						<ul class="list-group">
							@foreach($channels as $channel)
								<li class="list-group-item">
									<a href="{{ route('channel.show', ['slug'=>$channel->slug]) }}">{{ $channel->title }}</a>
								</li>
							@endforeach
						</ul>
					</div>			
				</div>
			</div>		
						
			
			<div class="col-md-8">							
				@yield('content')
				
			</div>
			
		</div>
		
		
	</div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
	@if(Session::has('success'))
		toastr.success('{{Session::get('success')}}')
	@endif
</script>
</body>
</html>




