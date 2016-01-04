@extends ('layouts.layout')
@section('title') BIENVENIDOS A LA PAGINA DE FARMACIAS @stop
@section('scripts')
<script>
	var marcadores_bd=[];	
	var map;
	$(document).on("ready",function(){
		
     	var mapOptions = {
		    zoom: 14,
   		    center: new google.maps.LatLng(-19.580170009928114, -65.75368881225586),
		    mapTypeId:google.maps.MapTypeId.HYBRID
		  };

		  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	 	 alert("Haga click sobre los rectangulos rojos para ver el nombre de las zonas, y sobre los marcadores para ver la informacion de la farmacia");
	 	 $.ajax({
			      type: 'GET',
			      url: '/iniciofarmacias',
			      dataType:'json',
			       success: function (data){
			 		   	 $.each(data,function(i,item)
			 		   	 {
			 		   	 	var posision=new google.maps.LatLng(data[i].puntox,data[i].puntoy);
			 		   	 	  var contentString ='<h1>'+"FARMACIA: "+data[i].nombre+'</h1>'+'<p><b>Telefono:</b>'+data[i].telefono+'</p>'+'<p><b>Direccion:</b>'+data[i].direccion+'</p>';
						      var infowindow = new google.maps.InfoWindow({
							      content: contentString,
							      maxWidth: 400
 							 });
 							 var marca=new google.maps.Marker({
 							 	position:posision 							 	
 							 });					
							google.maps.event.addListener(marca,"click",function()
							{
								infowindow.open(map,marca);
							});
							marcadores_bd.push(marca);
							marca.setMap(map);
		 		   	 		 		 	 
				    });		
			      }
			});
	 	 $.ajax({
			      type: 'GET',
			      url: '/nrzonas',
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
							  google.maps.event.addListener(polyy,"click",function(event)
							{
								infowindow.setPosition(event.latLng);
								infowindow.open(map);
							});
							 polyy.setMap(map);  
						});	 
		 		 	 
				    }		
			      
			    });
	 	 
	 	  	$('#btnzona').on('click', function() {
					 quitar_marcadores(marcadores_bd);
					  var dataString = $('#frmzona').serialize();
					  var zona=dataString.split("=");
   				     
		   			  var ur="/tzonafarmacias/"+zona[1];
		   			  $.ajax({
					      type: 'GET',
					      url: ur,
					      dataType:'json',
					      success: function (data){
					 			 $.each(data,function(i,item)
						 		   	 {
						 		   	 	var posision=new google.maps.LatLng(data[i].puntox,data[i].puntoy);
						 		   	 	  var contentString ='<h1>'+data[i].nombre+'</h1>'+'<p><b>Telefono:</b>'+data[i].telefono+'</p>'+'<p><b>Direccion:</b>'+data[i].direccion+'</p>';
									      var infowindow = new google.maps.InfoWindow({
										      content: contentString,
										      maxWidth: 400
			 							 });
			 							 var marca=new google.maps.Marker({
			 							 	position:posision 							 	
			 							 });					
										google.maps.event.addListener(marca,"click",function()
										{
											infowindow.open(map,marca);
										});
										marcadores_bd.push(marca);
										marca.setMap(map);
					 		   	 		 		 	 
							    });	
					 	  }
			   		 });
				 
				     return false;
			});
			$('#btnmedicamento').on('click', function() {
					 quitar_marcadores(marcadores_bd);
					  var dataString = $('#frmedicamento').serialize();
					  var medicamento=dataString.split("=");
   				     
		   			  var ur="/tmedicamentofarmacia/"+medicamento[1];
		   			  $.ajax({
					      type: 'GET',
					      url: ur,
					      dataType:'json',
					      success: function (data){
					 			 $.each(data,function(i,item)
						 		   	 {
						 		   	 	var posision=new google.maps.LatLng(data[i].puntox,data[i].puntoy);
						 		   	 	  var contentString ='<h1>'+data[i].nombre+'</h1>'+'<p><b>Telefono:</b>'+data[i].telefono+'</p>'+'<p><b>Direccion:</b>'+data[i].direccion+'</p>';
									      var infowindow = new google.maps.InfoWindow({
										      content: contentString,
										      maxWidth: 400
			 							 });
			 							 var marca=new google.maps.Marker({
			 							 	position:posision 							 	
			 							 });					
										google.maps.event.addListener(marca,"click",function()
										{
											infowindow.open(map,marca);
										});
										marcadores_bd.push(marca);
										marca.setMap(map);
					 		   	 		 		 	 
							    });	
					 	  }
			   		 });
				 
				     return false;
			});
			$('#btntod').on('click',function()
			{
				 quitar_marcadores(marcadores_bd);
				 $.ajax({
			      type: 'GET',
			      url: '/tfarmacias',
			      dataType:'json',
			       success: function (data){
			 		   	 $.each(data,function(i,item)
			 		   	 {
			 		   	 	var posision=new google.maps.LatLng(data[i].puntox,data[i].puntoy);
			 		   	 	  var contentString ='<h1>'+data[i].nombre+'</h1>'+'<p><b>Telefono:</b>'+data[i].telefono+'</p>'+'<p><b>Direccion:</b>'+data[i].direccion+'</p>';
						      var infowindow = new google.maps.InfoWindow({
							      content: contentString,
							      maxWidth: 400
 							 });
 							 var marca=new google.maps.Marker({
 							 	position:posision 							 	
 							 });					
							google.maps.event.addListener(marca,"click",function()
							{
								infowindow.open(map,marca);
							});
							marcadores_bd.push(marca);
							marca.setMap(map);
		 		   	 		 		 	 
				    });		
			      }
			 	});
			});
			$('#btnfarmacia').on('click', function() {
					quitar_marcadores(marcadores_bd);
					  var dataString = $('#frfarmacia').serialize();
					  var farmacia=dataString.split("=");
   				   
		   			  var ur="/buscarfarmacia/"+farmacia[1];
		   			  $.ajax({
					      type: 'GET',
					      url: ur,
					      dataType:'json',
					      success: function (data){
					      	
					 			   	 	var posision=new google.maps.LatLng(data[0].puntox,data[0].puntoy);
						 		   	 	  var contentString ='<h1>'+data[0].nombre+'</h1>'+'<p><b>Telefono:</b>'+data[0].telefono+'</p>'+'<p><b>Direccion:</b>'+data[0].direccion+'</p>';
									      var infowindow = new google.maps.InfoWindow({
										      content: contentString,
										      maxWidth: 400
			 							 });
			 							 var marca=new google.maps.Marker({
			 							 	position:posision 							 	
			 							 });					
										google.maps.event.addListener(marca,"click",function()
										{
											infowindow.open(map,marca);
										});
										marcadores_bd.push(marca);
										marca.setMap(map);
					 		   	 		 		 	 
							    
					 	  }
			   		 });
				 
				     return false;
			});
			$('#btnporturno').on('click',function()
			{
				 quitar_marcadores(marcadores_bd);
				 $.ajax({
			      type: 'GET',
			      url: '/tfarmaciasporturnos',
			      dataType:'json',
			       success: function (data){
			 		   	 $.each(data,function(i,item)
			 		   	 {
			 		   	 	var posision=new google.maps.LatLng(data[i].puntox,data[i].puntoy);
			 		   	 	  var contentString ='<h1>'+data[i].nombre+'</h1>'+'<p><b>Telefono:</b>'+data[i].telefono+'</p>'+'<p><b>Direccion:</b>'+data[i].direccion+'</p>';
						      var infowindow = new google.maps.InfoWindow({
							      content: contentString,
							      maxWidth: 400
 							 });
 							 var marca=new google.maps.Marker({
 							 	position:posision 							 	
 							 });					
							google.maps.event.addListener(marca,"click",function()
							{
								infowindow.open(map,marca);
							});
							marcadores_bd.push(marca);
							marca.setMap(map);
		 		   	 		 		 	 
				    });		
			      }
			 	});
			});
			
   				      
		
	});
		function quitar_marcadores(lista)
			{
				//RECORRER EL ARRAY DE MARCADORES
				for (i in lista) 
				{
					//quitar marcador del mapa
					lista[i].setMap(null);

				}
			}
	
	</script>
@stop	
@section('content')

<style>
			#map-canvas{
				width:1100px;
				height:550px;
				float:left;
				
			}
</style>

  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Potosi Farmacias</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{('/login')}}"><b>Ingreso Personal autorizado</b></a></li>
          </ul>
         </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
          	<li><br></li>
          	<li><br></li>
          	<li><br></li>
           
           	{{Form::open(array('id'=>'frmzona','method'=>'GET'),array('role'=>'form'))}}
	        	<select name="zona" id='cargo' class="form-control" placeholder="cargo">
						@foreach($zonas as $zona)
							<option name="zona">{{$zona->nombre}}</option>
						@endforeach
				</select>
				<br> 
				{{Form::button('Buscar Farmacias por zona',array('type'=>'submit','class'=>'btn btn-primary','id'=>'btnzona'))}}
			{{Form::close()}}
			<br>
			{{Form::open(array('id'=>'frmedicamento', 'method'=>'GET'),array('role'=>'form'))}}
	        	<input list="medicamento" name="medicamento" id='cargo' class="form-control" placeholder="ingrese medicamento"/>
	        	<datalist id="medicamento">
						@foreach($medicamentos as $medicamento)
							<option name="medicamento">{{$medicamento->nombre}}</option>
						@endforeach
	        	</datalist>
	        	<br> 
				{{Form::button('Farmacias por Medicamento',array('type'=>'submit','class'=>'btn btn-primary','id'=>'btnmedicamento'))}}
			{{Form::close()}}
			<br>
			{{Form::open(array('id'=>'frfarmacia', 'method'=>'GET'),array('role'=>'form'))}}
	        	<input list="farmacia" class="form-control" placeholder="farmacia" name="farmacia"/>
	        	<datalist id="farmacia">
						@foreach($farmacias as $farmacia)
							<option name="farmacia">{{$farmacia->nombre}}</option>
						@endforeach
	        	</datalist>
	        	<br> 
				{{Form::button('Buscar farmacia',array('type'=>'submit','class'=>'btn btn-primary','id'=>'btnfarmacia'))}}
			{{Form::close()}}<br>
				
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="#" id="btntod">Listar todas las farmacias</a></li>
            <li><a href="#" id="btnporturno">Listar farmacias de turno</a></li>
         </div>
        <br><br><br>
         <div id="map-canvas" class="container-fluid">
			
	 	</div>
      
      </div>
    </div>

	
@stop