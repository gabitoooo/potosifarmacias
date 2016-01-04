@extends('administrador.zonas.base')
@section('scripts')
<script>
	$(document).on("ready",function(){
				var mapOptions = {
			    center: new google.maps.LatLng(-19.580170009928114, -65.75368881225586),
			    zoom: 14,
			    mapTypeId:google.maps.MapTypeId.HYBRID,
			    };
			  var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
			<?php $claro=$zona->geolocalizacion_zona;
		  $json=json_encode($claro);
		 ?>
	 	 var zonasaa={{$json}};
	 	 //alert(zonasaa);
			var zon=zonasaa.split(",");
			var yo = new Array();
			var jj=0;
			for (var j =1   ; j <zon.length; j+=2) {
					  	 
				 yo[jj]=new google.maps.LatLng(zon[j],zon[j+1]);
				jj++;
			};
		     var centro_poly=new google.maps.Polygon({
		    	 paths:yo,
				 strokeColor:'#FF0000',
			     strokeOpacity:0.8,
				 strokeWeight:3,
				 fillColor:'#ff0000',
				fillOpacity:'.35',
				 
			 });
		centro_poly.setMap(map);	
				
		});
		
</script>
@stop		
@section('content')
<center><h2>Datos de la Zona</h2>
<p><b>Nombre:</b> {{$zona->nombre}}</p></center>
<style>
			#map-canvas{
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
<div id="map-canvas">
</div></td></td>
@stop