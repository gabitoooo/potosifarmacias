@extends('layoutsfarmacia.base')

@section('content')
<h2>Lista de medicamentos Farmacia: {{Session::get('farmacia')}} </h2>
	<table class="table table-striped">
		<tr>
			<th>Nombre</th>
			
			<th>Acciones</th>
		</tr>
		@foreach ($inventarios as $inventaro)
			<tr>
				<td>{{$inventaro->nombre}}</td>
				<td>
					{{ Form::model($inventaro,array('route'=>array('farma.destroy',$inventaro->id),'method'=>'DELETE', 'role'=>'form')) }}
						{{Form::submit('Delete',array('class'=>'btn btn-danger'))}}
					{{Form::close()}}
				</td>
			</tr>
			
		@endforeach
	</table>
@stop