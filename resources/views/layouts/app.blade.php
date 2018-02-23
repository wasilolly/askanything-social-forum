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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/askanything.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
		@include('layouts.nav')				
		
        <main class="py-4">
			<div class="container">
				<div class="row">
					@yield('content')
					
				</div>
			</div>	
        </main>
    </div>
	
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
	<script>
	@if(Session::has('success'))
		toastr.success('{{ Session::get('success')}}')
	@endif
	</script>
</body>
</html>
