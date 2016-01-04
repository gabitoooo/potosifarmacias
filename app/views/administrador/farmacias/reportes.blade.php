@extends('administrador.farmacias.base')
@section('scripts')
<script>
	$(document).on("ready",function(){
	var formulario=$("#formulario");
	var punto= new google.maps.LatLng(-19.580170009928114, -65.75368881225586);
				var config={
					zoom:14,
					center:punto,
					mapTypeId: google.maps.MapTypeId.HYBRID
				};
				var mapa=new google.maps.Map($("#mapa")[0],config);
	$.ajax({
     type: 'GET',
	url: '/marcarzonas',
	dataType:'json',
	success: function (data){
	$.each(data,function(i,item)
	{
		var yo = new Array();
    	var jj=0;
    	var geolo=data[i].geolocalizacion.split(",");
    	for (var j =1   ; j <geolo.length; j+=2) {
    		  
    		  yo[jj]=new google.maps.LatLng(geolo[j],geolo[j+1]);
    		  jj++;
    	}
    	  var polyy=new google.maps.Polygon({
    	  paths:yo,
    	  strokeColor:'#FF0000',
	         strokeOpacity:0.8,
    	  strokeWeight:3,
    	  fillColor:'#ff0000',
    	  fillOpacity:'.10',
    	  titulo:data[i].nombre	  
    	 });
    	  google.maps.event.addListener(polyy,"click",function(event)
	    	 {
    			formulario.find("input[name='zona']").val(polyy.titulo);
       	 	 });
    	  polyy.setMap(mapa);
		});
		 		 	 
		}		
	});
				
});
		
</script>
@stop		

@section('content')
<h2>REPORTES DE FARMACIAS</h2>
<style>
			#mapa{
				width:1000px;
				height:400px;
				float:left;
				background:green;
			}
			
			#infor{
				width:1000px;
				height:400px;
				float:left;
				
			}
</style>


<div id="mapa">
			<h2>Aqui ira el map!</h2>
</div></td></td>
{{Form::open(array('method' => 'GET','id'=>'formulario', 'url' => 'reportefarmaciaporzona', 'role' => 'form'))}}
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-2">
			{{Form::label('Zona','zona') }}
			{{Form::text('zona',null,array('placeholder'=>'zona','name'=>'zona','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('zona')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-2">
			{{Form::button('Mostrar reporte',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>		

{{Form::close()}}
@stop