@extends('administrador.zonas.base')

@section('content')

<h1>Editar usuario:</h1>



{{Form::model($zona,array('route'=>array('zona.update',$zona->id),'method'=>'PATCH'),array('role'=>'form'))}}
	<div class="row">
		<div class="form-group col-md-4">
			{{Form::label('zona','zona') }}
			{{Form::text('nombre',null,array('placeholder'=>'Nombre','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('nombre')}}</span>
		</div>
	</div>
	{{Form::button('Editar',array('type'=>'submit','class'=>'btn btn-primary'))}}
{{Form::close()}}


@stop