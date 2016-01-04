@extends('administrador.medicamentos.base')

@section('content')
<h2>Datos del medicamento</h2>
<p>Nombre:{{$medicamento->nombre}}</p>

<p>
	<a href="{{route('permisible.edit',$medicamento->id)}}" class="btn btn-primary">Editar</a>
</p>


@stop