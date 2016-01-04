<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//para usuarios no registrados
Route::get('/','NoregistradosController@index');
Route::get('/iniciofarmacias','NoregistradosController@iniciofarmacias');
Route::get('/tfarmacias','NoregistradosController@damefarmacias'); Route::get(
'/tfarmaciasporturnos','NoregistradosController@damefarmaciasporturno');
//Route::get('/tporzona','NoregistradosController@damefarmaciasporzona'); 
/*Ro
ute::get('saludo/{nombre}/{apellido?}',function($nombre,$apellido=null)//coloc
ar un signo de interrogacion en los parametros son opcionales =null no tiene
ningun valor, los parametros opcionales deben estar al final, losprimeros
parametros siempre son obligatorios y los segundos o finales opcionales. {
return 'hola '.$nombre.' '.$apellido; });*//*
Route::get('/tzonafarmacias/{nombre}',function($nombre){ 
	if(Request::ajax()){
			$zona=Zona::where('nombre','=',$nombre)->first();
			$farmacias=Zona::find($zona->id)->farmacias;
			for ($i=0; $i<count($farmacias) ; $i++)             {
						$geolocalizacion=Farmacia::find($farmacias[$i]->id)->geolocalizacion;
			$array[$i]=array("nombre"=>$farmacias[$i]->nombre,
			"telefono"=>$farmacias[$i]->telefono,
			"direccion"=>$farmacias[$i]->direccion,
			"puntox"=>$geolocalizacion->puntox,
			"puntoy"=>$geolocalizacion->puntoy);             }             echo
			json_encode($array);         } });
			Route::get('/tmedicamentofarmacia/{nombre}',function($nombre)//colocar unsigno de interrogacion en los parametros son opcionales =null no tiene ningunalor, los parametros opcionales deben estar al final, losprimeros parametros 	siempre son obligatorios y los segundos o finales opcionales. {     if
			(Request::ajax())         {
			$medicamento=Medicamentospermisible::where('nombre','=',$nombre)->first();
			$farmacias=Medicamentospermisible::find($medicamento->id)->farmacias;
			for ($i=0; $i <count($farmacias) ; $i++) {
			$geolocalizacion=Farmacia::find($farmacias[$i]->id)->geolocalizacion;
			$array[$i]=array("nombre"=>$farmacias[$i]->nombre,
			"telefono"=>$farmacias[$i]->telefono,
			"direccion"=>$farmacias[$i]->direccion,
			"puntox"=>$geolocalizacion->puntox,
			"puntoy"=>$geolocalizacion->puntoy);                     }
			echo json_encode($array);
							
			        } });
			 Route::get('/buscarfarmacia/{nombre}',function($nombre) { 
			   if(Request::ajax())         {
			$farmacia=Farmacia::where('nombre','=',$nombre)->first();
			$geolocalizacion=Farmacia::find($farmacia->id)->geolocalizacion;
			$array[0]=array("nombre"=>$farmacia->nombre,
			"telefono"=>$farmacia->telefono,
			"direccion"=>$farmacia->direccion,
			"puntox"=>$geolocalizacion->puntox,
			"puntoy"=>$geolocalizacion->puntoy);
								
						echo json_encode($array);
							
		}
});*/
Route::get('/nrzonas',function()
{
	if (Request::ajax()) {
						//$usuarios=Usuario::all()->lists('nick');
						//return Response::json(array('usuarios' => $usuarios));
						$zonas=Zona::all();
						for ($i=0; $i <count($zonas) ; $i++) { 
							$array[$i]=array("nombre"=>$zonas[$i]->nombre,"geolocalizacion"=>$zonas[$i]->geolocalizacion_zona);
						}
						//$array[0] = array("mensaje" => "Hola desde otro punto de la red","numero"=>"1234");
						//$array[1] = array("mensaje" => "ff","numero"=>"3333333");
						echo json_encode($array);
					}
});
//login de usuariosr
Route::get('/cerrarsession','UsuariosController@cerrarsession');

Route::get('/login','UsuariosController@get_login');
Route::post('/login','UsuariosController@controlar_ingreso');

//para el administrador


	Route::group(array('before' => 'administrador'), function()
	{
		
		Route::resource('admin','AdministradorController');
				
		Route::resource('farmacia','FarmaciasController');
		Route::get('reportefarmacia','FarmaciasController@reportes');
		Route::get('reportefarmaciaporzona','FarmaciasController@reportefarmaciaporzona');
		Route::get('reportefarmaciasgeneral','FarmaciasController@reportefarmaciasgeneral');

		Route::resource('usuario','UsuariosController');
		Route::get('reportegeneralusuarios','UsuariosController@reportegeneralusuarios');
		
		Route::resource('zona','ZonasController');
		Route::get('reportezonas','ZonasController@reportezonass');
		Route::get('/marcarzonas','ZonasController@damezonas');

		Route::resource('turno','TurnosController');
		Route::get('sorteoturno','TurnosController@sorteoturnos');
		Route::get('llenarturno','TurnosController@asignacionturnos');
		Route::get('sorteoturno','TurnosController@sorteoturnos');
		Route::get('eliminarturno','TurnosController@eliminarturnos');
		Route::get('Rturnos','TurnosController@Rturnos');
		Route::get('Rporfechaespecifica','TurnosController@Rporfechaespecifica');
		Route::get('Rpormes','TurnosController@Rpormes');
		Route::get('Rdehoy','TurnosController@Rdehoy');
		
	});

//para el farmaceutico
	Route::group(array('before'=>'farmacia'),function()
	{	
		Route::resource('farma','InventariosController');
		Route::get('listar','InventariosController@listar');

		Route::get('reportemedicamentos','InventariosController@reportemedicamentos');	
		Route::get('reporteturnos','InventariosController@reporteturnos');
		Route::get('cambiocontraseña','InventariosController@cambio');
		Route::get('actualizarcon','InventariosController@actualizarcon');
	});




