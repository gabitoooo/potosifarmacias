@extends('administrador.usuarios.base')

@section('content')

<center><h2>Lista de usuarios</h2></center>

	<table class="table table-striped">
		<tr>
			<th>nick</th>
			<th>cargo</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>

		@foreach ($usuarios as $usuario)
			<tr>
				<td>{{$usuario->nick}}</td>
				<td>{{$usuario->cargo}}</td>
				<td>
					<a href="{{route('usuario.show',$usuario->id)}}" class="btn btn-info">Ver</a>
					
				</td>
				<td>
					
					<a href="{{route('usuario.edit',$usuario->id)}}" class="btn btn-warning">Editar</a>
				</td>
				<td>
					@if($usuario->cargo!=="farmacia")
						{{ Form::model($usuario,array('route'=>array('usuario.destroy',$usuario->id),'method'=>'DELETE', 'role'=>'form')) }}
						{{Form::submit('Delete',array('class'=>'btn btn-danger'))}}
						{{Form::close()}}
					@endif
				</td>	
			</tr>
			
		@endforeach
	</table>

@stop