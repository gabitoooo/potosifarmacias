<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title','Aprendiendo Laravel')</title>
			{{HTML::style('assets/css/bootstrap.min.css',array('media'=>'screen'))}}
		<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		{{HTML::script('assets/js/bootstrap.min.js')}}
		<meta charset="utf-8" />
		<script type="text/javascript"
			  src="http://maps.googleapis.com/maps/api/js?sensor=false">
			</script>
			@yield('scripts')

	</head>
	<body>
		@yield('content')
				
	</body>
</html>