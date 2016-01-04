@extends('layoutsadministrador.baseturno')

@section('content')

<center><h1>Informacion sobre asignacion de turnos</h1>
 <?php 
 		$turnos=Turno::all()->lists('fechaturno');
		if (count($turnos)>0) {
			$primerturno=Turno::where('fechaturno','=',$turnos[0])->first();
			$farmacias=Turno::find($primerturno->id)->farmacias;
		}
		else
		{
			$farmacias=array();
		}
		
		
 ?>
@if(count($turnos)!=0)
	 <h2>Turnos</h2>	
	 <p>Las fechas de turnos ya fueron asignados, si desea asignarlos nuevamente eliminelos!</p>
@endif
@if(count($turnos)==0)
	<h2>Turnos</h2>
	<p>Turnos vacios puede asignarlos hacendo click en Asignar fechas para turnos</p>
@endif
@if(count($farmacias)!=0)
	<h2>Sorteo de turnos</h2>
	<p>Los turnos ya fueron sorteados, elimine los sorteos si desea sortear nuevamente los turnos</p>
@endif
@if(count($farmacias)==0)
	<h2>Sorteo de turnos</h2>
	<p> El sorteo de turnos esta disponible.</p>
@endif
</center>
@stop