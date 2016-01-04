@extends('layouts.base')

@section('content')

	{{Form::open(array('method' => 'POST', 'url' => '/login', 'role' => 'form'))}}
	<br><br><br>

	<div class="form-group">
		{{Form::label('Nick')}}
		{{Form::text('nick', '', array('class' => 'form-control'))}}
		<span class="help-block">{{ $errors->first('nick') }}</span>
	</div>
	<div class="form-group">
		{{Form::label('Contraseña')}}
		{{Form::password('password', array('class' => 'form-control'))}}
		<span class="help-block">{{ $errors->first('password') }}</span>
	</div>
	<div class="form-group">
		<p>{{Form::submit('Acceder', array('class' => 'btn btn-default'))}}</p>
	</div>

	{{Form::close()}}

@stop