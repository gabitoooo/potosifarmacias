Fecha:{{$fecha->fechaturno}}
<table width='100%' border='1' style="bold" align="center">
		<tr align="center">
		|<td colspan="1">Lista de Zonas</td>
		</tr>
		<tr>
			<th whidth="100%">Nombre Farmacia</th>
		</tr>
				
		@foreach ($farmacias as $farmacia)
		<tr>			
			<td align="center">{{$farmacia->nombre}}</td>
			
		</tr>			
		@endforeach
</table>