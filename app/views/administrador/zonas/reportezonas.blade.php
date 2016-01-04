<table width='100%' border='1' style="bold" align="center">
		<tr align="center">
		|<td colspan="2">Lista de Zonas</td>
		</tr>
		<tr>
			<th whidth="50%">Nombre Zona</th>
			<th whidth="50%">Registrado por administrador</th>
			
			
		</tr>
				
		@foreach ($zonas as $zona)
		<tr>			
			<td align="center">{{$zona->nombre}}</td>
			<?php $administrador=Zona::find($zona->id)->administrador;
				  $usuaro=Administradore::find($administrador->id)->usuario;
			?>
			<td align="center">{{$usuaro->nick}}</td>
		</tr>			
		@endforeach
</table>