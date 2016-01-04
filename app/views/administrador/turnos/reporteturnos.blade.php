@extends('layoutsadministrador.baseturno')

@section('content')
<center><h2>Reporte turno por fecha especifica</h2></center>
{{Form::open(array('method' => 'GET','id'=>'formulario', 'url' => 'Rporfechaespecifica', 'role' => 'form'))}}
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('fecha','Ingrese la fecha en el siguiente formato ejemplo: año-mes-dia ') }}
			{{Form::text('fecha',null,array('placeholder'=>'fecha','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('fecha')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::button('Introducir',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>
{{Form::close()}}
<center><h2>Reporte turno por mes</h2></center>
{{Form::open(array('method' => 'GET','id'=>'formulario', 'url' => 'Rpormes', 'role' => 'form'))}}
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('mes','Seleccione el mes') }}
			<select name="mes" class="form-control" placeholder="mes">
						<option name="mes">Enero</option>
						<option name="mes">Febrero</option>
						<option name="mes">Marzo</option>
						<option name="mes">Abril</option>
						<option name="mes">Mayo</option>
						<option name="mes">Junio</option>
						<option name="mes">Julio</option>
						<option name="mes">Agosto</option>
						<option name="mes">Septiembre</option>
						<option name="mes">Octubre</option>
						<option name="mes">Noviembre</option>
						<option name="mes">Diciembre</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::button('Introducir',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>
{{Form::close()}}
<center><h2>Reporte de turnos del dia de hoy</h2></center>
{{Form::open(array('method' => 'GET','id'=>'formulario', 'url' => 'Rdehoy', 'role' => 'form'))}}
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::button('Introducir',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>
{{Form::close()}}
@stop