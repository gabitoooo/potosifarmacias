<table width='100%' border='1' style="bold" align="center">
		<tr align="center">
		|<td colspan="1"><h2>Turnos de todo el año</h2></td>
		</tr>
		<tr>
			<th whidth="100%">Fecha de turno</th>
			
		</tr>
				
		@foreach ($turnos as $turno)
		<tr>			
			<td align="center">{{$turno->fechaturno}}</td>
		</tr>			
		@endforeach
</table>