@extends('administrador.usuarios.base')
@section('content')
<center>
<h2>Crear nuevo usuario</h2></center>
{{Form::open(array('route'=>'usuario.store', 'method'=>'POST'),array('role'=>'form'))}}
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('nick','Nick') }}
			{{Form::text('nick',null,array('placeholder'=>'nick','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('nick')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('password','Password') }}
			{{Form::password('password', array('class' => 'form-control','placeholder'=>'password'))}}
			<span class="help-block">{{$errors->first('password')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('repetir password','Repetir password') }}
			{{Form::password('repassword', array('class' => 'form-control','placeholder'=>'Repassword'))}}
			<span class="help-block">{{$errors->first('repassword')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('cargo','Cargo') }}
			<select name="cargo" id='cargo' class="form-control" placeholder="cargo">
					<option name="cargo" id='cadmi' placeholder="cargo">administrador</option>
			</select>
			<span class="help-block">{{$errors->first('cargo')}}</span>
		</div>
	</div>
	
	
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('nombre','Nombre') }}
			{{Form::text('nombre',null,array('placeholder'=>'Nombre','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('nombre')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('apellido paterno','Apellido Paterno') }}
			{{Form::text('apellidoPaterno',null,array('placeholder'=>'apellidoPaterno','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('apellidoPaterno')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('apellido materno','Apellido Materno') }}
			{{Form::text('apellidoMaterno',null,array('placeholder'=>'apellidoMaterno','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('apellidoMaterno')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('ci','Carnet de Identidad') }}
			{{Form::text('ci',null,array('placeholder'=>'ci','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('ci')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('telefono','Telefono/Celular') }}
			{{Form::text('telefono',null,array('placeholder'=>'telefono','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('telefono')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('direccion','Direccion') }}
			{{Form::text('direccion',null,array('placeholder'=>'direccion','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('direccion')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
		{{Form::button('Registrar Usuario',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>
	
	
{{Form::close()}}

@stop