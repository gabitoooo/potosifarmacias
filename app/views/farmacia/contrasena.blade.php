@extends('layoutsfarmacia.base')

@section('content')

{{Form::open(array('url'=>'actualizarcon', 'method'=>'GET'),array('role'=>'form'))}}
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-5">
			<h2>{{Form::label('nick',$usuario->nick) }}</h2>
	    </div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-5">
			{{Form::label('Pasworda','Ingrese el password que desea cambiar') }}
			{{Form::password('apasword',null,array('placeholder'=>'antiguo password','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('apasword')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-5">
			{{Form::label('npasword','Ingrese el nuevo password') }}
			{{Form::password('npasword',null,array('placeholder'=>'nuevo password','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('npasword')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-5">
			{{Form::label('Rpassword','Repita el Nuevo password') }}
			{{Form::password('Rpassword',null,array('placeholder'=>'Repita el Nuevo password','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('Rpassword')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-5">
			{{Form::button('Cambiar Contraseña',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>
	
{{Form::close()}}


@stop