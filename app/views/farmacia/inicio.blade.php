@extends('layoutsfarmacia.base')

@section('content')
<br><br>
<center><h1>Bienvenido al escritorio de la farmacia: {{Session::get('farmacia')}} </h1>
	<h2>Hoy la farmacia {{Session::get('farmacia')}} en fecha, {{$fechahoy}}: {{$mensaje}}</h2>
	<p>Hola {{Session::get('usuario_nick')}}</p>
	<p><a href="/cerrarsession">¿Salir?</a></p></center>
	

@stop