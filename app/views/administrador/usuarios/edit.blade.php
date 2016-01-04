@extends('administrador.usuarios.base')

@section('content')
<center>
<h1>Editar usuario:</h1></center>

{{Form::model($usuario,array('route'=>array('usuario.update',$usuario->id),'method'=>'PATCH'),array('role'=>'form'))}}
<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('nick','Nick') }}
			{{Form::text('nick',null,array('placeholder'=>'nick','class'=>'form-control','disabled'=>'disabled'))}}
			<span class="help-block">{{$errors->first('nick')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('password','Password') }}
			{{Form::password('password', array('class' => 'form-control','placeholder'=>'password'))}}
			<span class="help-block">{{$errors->first('password')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('repetir password','Repetir password') }}
			{{Form::password('repassword', array('class' => 'form-control','placeholder'=>'Repassword'))}}
			<span class="help-block">{{$errors->first('repassword')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('cargo','Cargo') }}
			<select name="cargo" id='cargo' disabled="disabled" class="form-control" placeholder="cargo">
					@if($usuario->cargo=="administrador")
						<option name="cargo" id='cadmi' placeholder="cargo">administrador</option>
						<option name="cargo" placeholder="cargo">farmacia</option>
					@endif	
					@if($usuario->cargo=="farmacia")
						<option name="cargo" placeholder="cargo">farmacia</option>
						<option name="cargo" id='cadmi' placeholder="cargo">administrador</option>
					@endif	
					
			</select>
			<span class="help-block">{{$errors->first('cargo')}}</span>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('farmacia','Farmacia asignada') }}
			<select name="farmacia" class="form-control" disabled="disabled" placeholder="farmacia">
				@if($usuario->cargo=="administrador")
				@endif	
				@if($usuario->cargo=="farmacia")
					<option name="farmacia">{{$farmacia->nombre}}</option>
					@foreach ($farmacias as $farma)
						@if($farma->nombre != $farmacia->nombre)
							<option name="farmacia">{{$farma->nombre}}</option>	
						@endif
					
					@endforeach
				@endif	
					
			</select>
			
		</div>
	</div>
	<div clas
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('nombre','Nombre') }}
			{{Form::text('nombre',$persona->nombre,array('placeholder'=>'Nombre','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('nombre')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('apellido paterno','Apellido Paterno') }}
			{{Form::text('apellidoPaterno',$persona->apellidoPaterno,array('placeholder'=>'apellidoPaterno','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('apellidoPaterno')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('apellido materno','Apellido Materno') }}
			{{Form::text('apellidoMaterno',$persona->apellidoMaterno,array('placeholder'=>'apellidoMaterno','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('apellidoMaterno')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('ci','Carnet de Identidad') }}
			{{Form::text('ci',$persona->ci,array('placeholder'=>'ci','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('ci')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('telefono','Telefono/Celular') }}
			{{Form::text('telefono',$persona->telefono,array('placeholder'=>'telefono','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('telefono')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::label('direccion','Direccion') }}
			{{Form::text('direccion',$persona->direccion,array('placeholder'=>'direccion','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('direccion')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4 col-lg-offset-4">
			{{Form::button('Editar',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>
	
{{Form::close()}}


@stop