@extends('administrador.usuarios.base')

@section('content')
<center>
<h2>Datos del usario</h2>
@if($usuario->cargo=="administrador")
<p>nick:{{$usuario->nick}}</p>
<p>cargo:{{$usuario->cargo}}</p>
<p>nombre:{{$persona->nombre}}</p>
<p>apellido Paterno:{{$persona->apellidoPaterno}}</p>
<p>apellido Materno:{{$persona->apellidoMaterno}}</p>
<p>ci:{{$persona->ci}}</p>
<p>telefono:{{$persona->telefono}}</p>
<p>direccion:{{$persona->direccion}}</p>
@endif
@if($usuario->cargo=="farmacia")
<p>nick:{{$usuario->nick}}</p>
<p>cargo:{{$usuario->cargo}}</p>
<p>encargado de farmacia:{{$farmacia->nombre}}</p>
<p>nombre:{{$persona->nombre}}</p>
<p>apellido Paterno:{{$persona->apellidoPaterno}}</p>
<p>apellido Materno:{{$persona->apellidoMaterno}}</p>
<p>ci:{{$persona->ci}}</p>
<p>telefono:{{$persona->telefono}}</p>
<p>direccion:{{$persona->direccion}}</p>
@endif


<p>
	<a href="{{route('usuario.edit',$usuario->id)}}" class="btn btn-primary">Editar</a>
</p>

</center>
@stop