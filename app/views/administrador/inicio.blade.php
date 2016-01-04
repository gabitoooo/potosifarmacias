@extends('layoutsadministrador.baseadiminstrador')

@section('content')
	<br><br>
	<center>
	<h1>ESCRITORIO DEL ADMINISTRADOR</h1>

	<p >Bienvenido! {{Session::get('usuario_nick')}}</p>
	<p><a href="/cerrarsession">¿Salir?</a></p>
</center>
@stop