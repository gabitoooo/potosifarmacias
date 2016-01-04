<table width='100%' border='1' style="bold" align="center">
		<tr align="center">
		|<td colspan="1">Inventario</td>
		</tr>
		<tr>
			<th whidth="100%">Nombre Medicamento</th>
			
		</tr>
				
		@foreach ($medicamentos as $medicamento)
		<tr>			
			<td align="center">{{$medicamento->nombre}}</td>
		</tr>			
		@endforeach
</table>