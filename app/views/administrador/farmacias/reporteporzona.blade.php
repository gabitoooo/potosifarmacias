<table width='100%' border='1' style="bold" align="center">
		<tr align="center">
		|<td colspan="6">Zona : {{$zona->nombre}} </td>
		</tr>
		<tr>
			<th whidth="15%">Farmacia</th>
			<th whidth="15%">direccion</th>
			<th whidth="15%">telefono</th>
			<th whidth="15%">Encargado</th>
			<th whidth="15%">Telefono encargado</th>			
			<th whidth="15%">Registrado por Administrador</th>
			
		
		</tr>
				
		@foreach ($farmacias as $farmacia)
		<tr>			
			<td>{{$farmacia->nombre}}</td>
			<td>{{$farmacia->direccion}}</td>
			<td>{{$farmacia->telefono}}</td>
			@if($farmacia->habilitado=="si")
				<?php $encargado=Farmacia::find($farmacia->id)->encargadofarmacia;
					  $persona=Persona::where('usuario_id','=',$encargado->usuario_id)->first();
				 ?>
				 <td>{{$persona->nombre}}</td>
				 <td>{{$persona->telefono}}</td>
			 @endif
			 @if($farmacia->habilitado=="no")
			 	 <td>{{ "no asignado" }}</td>
				 <td>{{ "no asignado"  }}</td>
			 @endif
			 		<?php $admin=Farmacia::find($farmacias[0]->id)->administrador;
							$user=Administradore::find($admin->id)->usuario;
					  ?>
			 <td>{{$user->nick}}</td>	
		</tr>			
		@endforeach
</table>