@extends('administrador.medicamentos.base')

@section('content')

<h2>Introducir medicamento permisible</h2>
{{Form::open(array('route'=>'permisible.store', 'method'=>'POST'),array('role'=>'form'))}}
	<div class="row">
		<div class="form-group col-md-4">
			{{Form::label('nombre','nombre') }}
			{{Form::text('nombre',null,array('placeholder'=>'Nombre','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('nombre')}}</span>
		</div>
	</div>
	
	{{Form::button('Introducir',array('type'=>'submit','class'=>'btn btn-primary'))}}
{{Form::close()}}

@stop