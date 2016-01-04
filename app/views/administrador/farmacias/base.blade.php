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
				<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			      <div class="container-fluid">
			        <div class="navbar-header">
			            <a class="navbar-brand" href="#">Administrador:{{Session::get('usuario_nick')}}</a>
			        </div>
			        <div class="navbar-collapse collapse">
			          <ul class="nav navbar-nav navbar-right">
			            <li><a href="{{URL::to('/')}}">Inicio</a></li>
			          </ul>
			          
			        </div>
			      </div>
			    </div>
			</div>
		</div>
		<br>
		<div class="container-fluid" >
			<div class="col-lg-9">
				@yield('content')
			</div>

			<div class="col-lg-3">
				@include('administrador.farmacias.slidebar')
			</div>
		</div>

		<div class="row">
			<div class="col-lg-7 col-lg-offset-3">
				<footer>
					
				</footer>
			</div>
		</div>

	</div>

	
	
</body>
</html>