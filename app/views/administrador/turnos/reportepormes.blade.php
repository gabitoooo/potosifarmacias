<table width='100%' border='1' style="bold" align="center">
		<tr align="center">
		|<td colspan="1">Mes de {{$nombremes}}</td>
		</tr>
		<tr>
			<th whidth="20%">Dia</th>
			<th whidth="80%">Nombre Farmacia</th>
			
		</tr>
		<?php $i=0;?>		
		@foreach ($fec as $fee)
					<?php $i++; ?>
					@foreach($fee as $fe)
						<tr>
							<td align="center">{{$i}}</td>			
							<td align="center">{{$fe->nombre}}</td>
						</tr>
					@endforeach

		@endforeach
</table>