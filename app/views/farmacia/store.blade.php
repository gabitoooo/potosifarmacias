@extends('layoutsfarmacia.base')

@section('content')
<center><h2>Agregar nuevo medicamento</h2></center>
{{Form::open(array('route'=>'farma.store', 'method'=>'POST'),array('role'=>'form'))}}
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-3">
			{{Form::label('medicamento','medicamento') }}
			<input list="permitido" name="permitido" id='cargo' class="form-control" placeholder="ingrese medicamento">
	        	<datalist id="permitido" name="permitido">
						@foreach($permitidos as $permitido)
							<option name="permitido">{{$permitido}}</option>
						@endforeach
	       		 </datalist>
			
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-4">
			{{Form::button('Agrregar medicamento',array('type'=>'submit','class'=>'btn btn-primary'))}}
	</div>
	</div>
	
	
{{Form::close()}}

@stop