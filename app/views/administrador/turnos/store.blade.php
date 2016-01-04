@extends('layoutsadministrador.baseturno')

@section('content')
<center>
<h2>Asignar turno a farmacia nueva</h2></center>
{{Form::open(array('route'=>'turno.store', 'method'=>'POST'),array('role'=>'form'))}}
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('farmacia','Elija la farmacia para sortearle un turno') }}
			<select name="farmacia" class="form-control" placeholder="farmacia">
					@foreach ($farmacias as $farmacia)
						<option name="farmacia">{{$farmacia->nombre}}</option>
					@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::button('Introducir',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>
	
	
{{Form::close()}}
@stop