<div class="block col-lg-offset-1">
	<h3>Menú principal</h3>
	<ul>
		<!-- <li><a href="{{URL::to('/')}}">Inicio</a></li>
		<li><a href="{{URL::to('/admi/crearmedicamento')}}">Registrar medicamento permisible</a></li>
		<li><a href="{{URL::to('admi/administrar')}}">Panel de Administración</a></li>-->
		<li><a href="{{route('usuario.index')}}">Controlar Usuarios</a></li>
		<li><a href="{{route('zona.index')}}">Controlar Zonas</a></li>
		<li><a href="{{route('farmacia.index')}}">Controlar Farmacias</a></li>
		<li><a href="{{route('turno.index')}}">Controlar Asignacion de turnos</a></li>		
	</ul>
</div>

<div class="block col-lg-offset-1">
	<h3>Zona de Usuarios</h3>
	@if(!Session::has('usuario_id'))
		<ul>
			<li><a href="{{URL::to('/login')}}">Acceder</a></li>
			<li><a href="{{URL::to('/signup')}}">Registrarse</a></li>
		</ul>
	@else
		<p>¡Hola {{Session::get('usuario_nick')}}!</p>
		<p><a href="/cerrarsession">¿Salir?</a></p>
	@endif
</div>