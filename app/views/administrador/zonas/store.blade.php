@extends('administrador.zonas.base')
@section('scripts')
<script>
		
		var verdad=false;
		var marcadores_bd=[];
		var poly;
		var map;
		var i=0;
		var todo = new Array();
		var union="";
		function addLatLng(event) {
	      var path = poly.getPath();
		  todo[i]=event.latLng;
		  var geo=todo[i].toString().split("(");
		  var ta=geo.toString().split(")");
		  union+=ta[0];
		   i++;
		  path.push(event.latLng);
		  var marker = new google.maps.Marker({
		    position: event.latLng,
		    title: '#' + path.getLength(),
		    map: map
		  });
		  
		}
		$(document).on("ready",function(){
		

		var formulario=$("#formulario");
		formulario.find("input[name='coordenadas']").val(null);
		var mapOptions = {
		    zoom: 14,
   		    center: new google.maps.LatLng(-19.580170009928114, -65.75368881225586),
		    mapTypeId:google.maps.MapTypeId.HYBRID
		  };

		  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		  var polyOptions = {
		    strokeColor: '#000000',
		    strokeOpacity: 1.0,
		    strokeWeight: 3
		  };
		  poly = new google.maps.Polyline(polyOptions);
		  poly.setMap(map);

		  // Add a listener for the click event
		  google.maps.event.addListener(map, 'click', addLatLng);
		 
		  $("button[name=area]").click(function(){
          		 if (verdad==false)
          		 {
          		 	formulario.find("input[name='coordenadas']").val(union);
          		 var centro_poly=new google.maps.Polygon({
				 paths:todo,
				 strokeColor:'#FF0000',
				 strokeOpacity:0.8,
				 strokeWeight:3,
				 fillColor:'#ff0000',
				 fillOpacity:'.35',
				 titulo:"zona centro"
				 });
				 centro_poly.setMap(map);
				 verdad=true;
          		 };
          		 
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
							  fillOpacity:'.35',
							  titulo:data[i].nombre	  
							 });
							  google.maps.event.addListener(polyy,"click",function()
						 	  {
									    alert(polyy.titulo);
							  });
							  polyy.setMap(map);
			 		   	 });
		 		 	 
				    }		
			      
			    });
			

		});
		
		
			
		
		
				
</script>
@stop		
@section('content')
<h2>Crear Nueva Zona</h2>
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
			#novisible
	{
	visibility:hidden;
	} 
	
</style>
<button type="button" class="btn btn-primary" name="area">Cerrar el area del poligono</button>
<div id="map-canvas">
			
</div></td></td>
{{Form::open(array('route'=>'zona.store','method'=>'POST','id'=>'formulario'),array('role'=>'form'))}}
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-2">
			{{Form::label('zona','Zona') }}
			{{Form::text('nombre',null,array('placeholder'=>'zona','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('nombre')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-4">
			{{Form::button('Registrar',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div> 
	<div class="row" id="novisible">
		<div class="form-group col-md-6 col-lg-offset-2">
			 {{Form::label('Coordenadas','Coordenadas') }}
		     <input type="text" class="form-control" name="coordenadas">
		     <span class="help-block">{{$errors->first('coordenadas')}}</span>
		</div>
	</div> 
	
{{Form::close()}}
@stop




