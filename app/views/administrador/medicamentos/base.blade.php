<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>
		@section('titulo')
			Administrador
		@show 
		 | 
	</title>
	{{HTML::style('assets/css/bootstrap.min.css',array('media'=>'screen'))}}
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	{{HTML::script('assets/js/bootstrap.min.js')}}
	<meta charset="utf-8" />
	<script type="text/javascript"
		  src="http://maps.googleapis.com/maps/api/js?sensor=false">
		</script>
 @yield('scripts')
	<!-- CSS -->
	
</head>
<body>

	<div class="container-full">

		<div class="row">
			<div class="col-lg-7 col-lg-offset-3" style="margin-bottom:50px;">
				<p>Administrado</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-5 col-lg-offset-3">
				@yield('content')
			</div>

			<div class="col-lg-2">
				@include('administrador.medicamentos.slidebar')
			</div>
		</div>

		<div class="row">
			<div class="col-lg-7 col-lg-offset-3">
				<footer>
					<p></p>
				</footer>
			</div>
		</div>

	</div>

	
	
</body>
</html>