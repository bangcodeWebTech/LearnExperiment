<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="_token" content="{{csrf_token()}}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>

	<div class="container mt-4">
		@yield('content')
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
	<!-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> -->
	<script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
	@yield('script')
</body>
</html>