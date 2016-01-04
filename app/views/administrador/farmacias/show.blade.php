@extends('administrador.farmacias.base')
@section('scripts')
<script>
	$(document).on("ready",function(){

	var px= {{$geolocalizacion->puntox}};
    var py= {{$geolocalizacion->puntoy}};
	var myLatlng = new google.maps.LatLng(px,py);
	var mapOptions = {
	zoom: 14,
    center: myLatlng,
	mapTypeId: google.maps.MapTypeId.HYBRID
	}
	var mapa = new google.maps.Map(document.getElementById('mapa'), mapOptions);

	var marker = new google.maps.Marker({
    position: myLatlng,
	map: mapa,
	mapTypeId: google.maps.MapTypeId.HYBRID
	});
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
    			alert(polyy.titulo);
    	  });
    	  polyy.setMap(mapa);
		});
		 		 	 
		}		
	});
				
});
		
</script>
@stop		
@section('content')
<center><h2>Datos de la farmacia</h2>
<p>Nombre:{{$farmacia->nombre}}</p>
<p>telefono:{{$farmacia->telefono}}</p>
<p>direccion:{{$farmacia->direccion}}</p>
<p>Zona:{{$zona->nombre}}</p>
<p>Nick Encargado:{{$encargado->nick}}</p>
<p>
	<a href="{{route('farmacia.edit',$farmacia->id)}}" class="btn btn-primary">Editar</a>
</p>
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
</center>



@stop