@extends('administrador.zonas.base')

@section('content')

<h2>Lista de Zonas</h2>

	<table class="table table-striped">
		<tr>
			<th>Nombre</th>
			
			<th></th>
			<th></th>
		</tr>
		@foreach ($zonas as $zona)
			<tr>
				<td>{{$zona->nombre}}</td>
				
				<td>
					<a href="{{route('zona.show',$zona->id)}}" class="btn btn-info">Ver</a>
					
				</td>
				<td>
					
					{{ Form::model($zona,array('route'=>array('zona.destroy',$zona->id),'method'=>'DELETE', 'role'=>'form')) }}
						{{Form::submit('Delete',array('class'=>'btn btn-danger'))}}
					{{Form::close()}}
				</td>
			</tr>
			
		@endforeach
	</table>

@stop