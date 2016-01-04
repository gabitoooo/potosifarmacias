<table width='100%' border='1' style="bold" align="center">
		<tr align="center">
		|<td colspan="8">Lista de Usuarios</td>
		</tr>
		<tr>
			<th whidth="22%">nick</th>
			<th whidth="13%">cargo</th>
			<th whidth="13%">ci</th>
			<th whidth="13%">Nombre</th>
			<th whidth="13%">Apellido Paterno</th>
			<th whidth="13%">Apellido Materno</th>
			<th whidth="13%">Direccion</th>
			<th whidth="13%">Telefono</th>
		
		</tr>
				
		@foreach ($usuarios as $usuario)
		<tr>			
			<td>{{$usuario->nick}}</td>
			<td>{{$usuario->cargo}}</td>
			<?php $persona=Usuario::find($usuario->id)->persona?>
			<td>{{$persona->ci}}</td>
			<td>{{$persona->nombre}}</td>
			<td>{{$persona->apellidoPaterno}}</td>
			<td>{{$persona->apellidoMaterno}}</td>
			<td>{{$persona->direccion}}</td>
			<td>{{$persona->telefono}}</td>
		</tr>			
		@endforeach
</table>