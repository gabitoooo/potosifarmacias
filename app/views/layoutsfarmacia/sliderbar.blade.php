<div class="block col-lg-offset-1">
	<h3>Menú principal</h3>
	<ul>
		<!-- <li><a href="{{URL::to('/')}}">Inicio</a></li>
		<li><a href="{{URL::to('/admi/crearmedicamento')}}">Registrar medicamento permisible</a></li>
		<li><a href="{{URL::to('admi/administrar')}}">Panel de Administración</a></li>-->
		<li><a href="{{ route('farma.index')}}">Escritorio farmacia</a></li>
		<li><a href="{{ route('farma.create')}}">LLenar inventarios</a></li>
		<li><a href="{{ URL::to('listar')}}">Listar medicamentos</a></li>
		<li><a href="{{URL::to('reportemedicamentos')}}">Ver reporte de medicamentos</a></li>
		<li><a href="{{URL::to('reporteturnos')}}">Ver reporte de mis turnos</a></li>
		<li><a href="{{URL::to('cambiocontraseña')}}">Cambiar de Contraseña</a></li>
	

	</ul>
</div>

<div class="block col-lg-offset-1">
	<h3>Zona de Usuarios</h3>
	@if(!Session::has('usuario_id'))
		<ul>
			<li><a href="{{URL::to('/login')}}">Acceder</a></li>
		</ul>
	@else
		<p>Encargado de farmacia: {{Session::get('farmacia')}}</p>
		<p>¡Hola {{Session::get('usuario_nick')}}!</p>
		<p><a href="/cerrarsession">¿Salir?</a></p>
	@endif
</div>