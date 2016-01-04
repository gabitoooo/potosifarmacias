@extends('administrador.medicamentos.base')

@section('content')

<h2>Lista de medicamentos</h2>

	<table class="table table-striped">
		<tr>
			<th>Nombre</th>
			
			<th>Acciones</th>
		</tr>
		@foreach ($medicamentos as $medicamento)
			<tr>
				<td>{{$medicamento->nombre}}</td>
				
				<td>
					<a href="{{route('permisible.show',$medicamento->id)}}" class="btn btn-info">Ver</a>
					<a href="{{route('permisible.edit',$medicamento->id)}}" class="btn btn-warning">Editar</a>
					{{ Form::model($medicamento,array('route'=>array('permisible.destroy',$medicamento->id),'method'=>'DELETE', 'role'=>'form')) }}
						{{Form::submit('Delete',array('class'=>'btn btn-danger'))}}
					{{Form::close()}}
				</td>
			</tr>
			
		@endforeach
	</table>

@stop