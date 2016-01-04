@extends('administrador.farmacias.base')

@section('content')

<h2 class="col-lg-offset-6">Lista de Farmacias</h2>


	<table class="table table-striped">
		<tr>
			<th class="col-lg-4">Nombre</th>
			<th>telefono</th>
			<th>direccion</th>
			<th ></th>
			<th ></th>
			<th ></th>
		</tr>
		@foreach ($farmacias as $farmacia)
			<tr>
				<td>{{$farmacia->nombre}}</td>
				<td>{{$farmacia->telefono}}</td>
				<td>{{$farmacia->direccion}}</td>
				<td>
					<a href="{{route('farmacia.show',$farmacia->id)}}" class="btn btn-info">Ver</a>
					
				</td>
				<td>
					
					<a href="{{route('farmacia.edit',$farmacia->id)}}" class="btn  btn-warning">Editar</a>
					
				</td>
				<td>
					
					{{ Form::model($farmacia,array('route'=>array('farmacia.destroy',$farmacia->id),'method'=>'DELETE', 'role'=>'form')) }}
						{{Form::submit('Delete',array('class'=>'btn  btn-danger'))}}
					{{Form::close()}}
				</td>
			</tr>
			
		@endforeach
	</table>

@stop