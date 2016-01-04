@extends('administrador.farmacias.base')

@section('scripts')
<script>
			//VARIABLES GENERALES
			//ARRAY PARA ALACENAR NUEVOS MARCADORES
			var marcadores_nuevos=[];

			//FUNCION PARA QUITAR MARCADORES DE MAPA
				
			function quitar_marcadores(lista)
			{
				//RECORRER EL ARRAY DE MARCADORES
				for (i in lista) 
				{
					//quitar marcador del mapa
					lista[i].setMap(null);

				}
			}
			//$(document).on("ready",function(){alert(1);});
			$(document).on("ready",function(){

				var formulario=$("#formulario");
				formulario.find("input[name='cx']").val();
				formulario.find("input[name='cy']").val();
				  var px= {{$geolocalizacion->puntox}};
				  var py= {{$geolocalizacion->puntoy}};
				  var myLatlng = new google.maps.LatLng(px,py);
				  var mapOptions = {
				    zoom: 18,
				    center: myLatlng,
				    mapTypeId: google.maps.MapTypeId.HYBRID
				  }
				  var mapa = new google.maps.Map(document.getElementById('mapa'), mapOptions);

				  var marker = new google.maps.Marker({
				      position: myLatlng,
				      map: mapa,
				      mapTypeId: google.maps.MapTypeId.HYBRID
				  });
				  marcadores_nuevos.push(marker);
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
							  var contentString ='<h1>'+"Esta es la zona:"+polyy.titulo+'</h1>';
						      var infowindow = new google.maps.InfoWindow({
							      content: contentString,
							      maxWidth: 400
 							 });
						      var cierto=false;
						      google.maps.event.addListener(polyy,"mouseover",function(event)
						 	  {
						 	  		if (cierto==false) {
									infowindow.setPosition(event.latLng);
						     		 infowindow.open(mapa);
						     		 cierto=true;

						 	  		};
						 	  		
						 	  });
						 	  google.maps.event.addListener(polyy,"mouseout",function(event)
						 	  {
						 	  		if (cierto==true) {
										infowindow.setPosition(null);
						     		 	infowindow.open(null);
						     		 cierto=false;

						 	  		};
						 	  		
						 	  });
							  

							  google.maps.event.addListener(polyy,"click",function(event)
						 	  {
									//alert(polyy.titulo);
									formulario.find("input[name='zona']").val(polyy.titulo);
									var coordenadas=event.latLng.toString();
									var suma="";
									for (var i = 1; i < coordenadas.length-1; i++) {
										suma+=coordenadas[i];
									}
									var lista=suma.split(",");
									//alert("Las coordenadas en x es: "+lista[0]);
									//alert("Las coordenadas en y es: "+lista[1]);
									//variable para direccion,puno o coordenadas
									var direccion=event.latLng;
									//variable marcador
									var marcador=new google.maps.Marker({
										//titulo:prompt("Digite nombre del marcador"),//te permite introducir un nombre por teclado para el marcador
										position:direccion,//la posision del nuevo maracadr
										map:mapa,//en que mapa se hubicara el marcador
										animation:google.maps.Animation.DROP,//Como aparacera el marcador
										draggable:false//no permitir el arrastre del marcador
									});

									//pasar las coordenadas al formulario
									formulario.find("input[name='cx']").val(lista[0]);
									formulario.find("input[name='cy']").val(lista[1]);
									//UBICAR EL FOCO EN EL CAMPO TITULO
									formulario.find("input[name='titulo']").val(null);
									formulario.find("input[name='titulo']").focus();
									//DEJAR SOLO 1 MARCADOR EN EL MAPA
									//GUARDAR EL MARCADOR EN EL ARRAY
									marcadores_nuevos.push(marcador);
									quitar_marcadores(marcadores_nuevos);
									marcador.setMap(mapa);
							  });
							  polyy.setMap(mapa);
			 		   	 });
		 		 	 
				    }		
			      
			    });
				
	    });
			
			
		</script>
@stop		
@section('content')
<h2><center>Editar Farmacia</center></h2>
<style>
			#mapa{
				width:1000px;
				height:400px;
				float:left;
				background:green;
			}
			#ocultar{
				visibility: hidden;
			}
</style>
			



<div id="mapa">
		<h2>Aqui ira el map!</h2>
</div></td></td>


{{Form::model($farmacia,array('route'=>array('farmacia.update',$farmacia->id),'method'=>'PATCH','id'=>'formulario'),array('role'=>'form'))}}

	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-2">
			{{Form::label('Farmacia','nombre') }}
			{{Form::text('nombre',null,array('class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('nombre')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-2">
			{{Form::label('Telefono','telefono') }}
			{{Form::text('telefono',null,array('placeholder'=>'telefono','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('telefono')}}</span>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-2">
			{{Form::label('Direccion','direccion') }}
			{{Form::text('direccion',null,array('placeholder'=>'direccion','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('direccion')}}</span>

		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6 col-lg-offset-2">
			 {{Form::button('Editar',array('type'=>'submit','class'=>'btn btn-primary'))}}
		</div>
	</div>  
		<div class="row" id="ocultar">
		<div class="form-group col-md-6 col-lg-offset-2">
			{{Form::label('Zona','zona') }}
			{{Form::text('zona',$zonai->nombre,array('name'=>'zona','class'=>'form-control'))}}
			<span class="help-block">{{$errors->first('zona')}}</span>
		</div>
	</div>
	 <div class="row" id="ocultar">
		    <div class="form-group col-md-6 col-lg-offset-2">
				{{Form::label('Coordenada X','Coordenada X') }}
				{{Form::text('cx',$geolocalizacion->puntox,array('name'=>'cx','class'=>'form-control'))}}
				 <span class="help-block">{{$errors->first('cx')}}</span>
			</div>
	</div> 
	<div class="row" id="ocultar">
		<div class="form-group col-md-6 col-lg-offset-2">
			 {{Form::label('Coordenada Y','Coordenada Y') }}
			 {{Form::text('cy',$geolocalizacion->puntoy,array('name'=>'cy','placeholder'=>'Coordenada y','class'=>'form-control'))}}
			 <span class="help-block">{{$errors->first('cy')}}</span>
		</div>
	</div>
	

	
{{Form::close()}}

@stop