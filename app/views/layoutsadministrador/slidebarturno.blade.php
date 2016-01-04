<div class="block col-lg-offset-1">
	<h3>Menú principal</h3>
	<ul>
		<!-- <li><a href="{{URL::to('/')}}">Inicio</a></li>
		<li><a href="{{URL::to('/admi/crearmedicamento')}}">Registrar medicamento permisible</a></li>
		<li><a href="{{URL::to('admi/administrar')}}">Panel de Administración</a></li>-->
		
		<li><a href="{{ route('admin.index')}}">Escritorio Administrador</a></li>
		<li><a href="{{URL::to('llenarturno')}}">Asignar fechas para turnos</a></li>
		<li><a href="{{URL::to('sorteoturno')}}">Sortear Fechas de turnos a farmacias</a></li>
		<li><a href="{{route('turno.create')}}">Asignar turno a farmacia nueva (sorteo)</a></li>
		<li><a href="{{URL::to('eliminarturno')}}">Eliminar turnos y sorteos</a></li>
		<li><a href="{{URL::to('Rturnos')}}">Reportes turnos</a></li>
	



	</ul>
</div>

<div class="block col-lg-offset-1">
	<h3>Zona de Usuarios</h3>
	@if(!Session::has('usuario_id'))
		<ul>
			<li><a href="{{URL::to('/login')}}">Acceder</a></li>
	</ul>
	@else
		<p>¡Hola {{Session::get('usuario_nick')}}!</p>
		<p><a href="/cerrarsession">¿Salir?</a></p>
	@endif
</div>