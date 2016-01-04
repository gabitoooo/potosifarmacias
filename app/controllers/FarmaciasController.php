<?php

class FarmaciasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$farmacias=Farmacia::orderBy('nombre', 'ASC')->get();
		return View::make('administrador.farmacias.list')->with('farmacias',$farmacias);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('administrador.farmacias.farmacia');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$todo=Input::all();
		$reglas = array(
			'nombre_farmacia'	=>	'required|unique:farmacias,nombre',
			'telefono_farmacia'	=>	'required|numeric',
			'direccion_farmacia'	=>	'required',
			'cx'	=>	'required|numeric',
			'cy'	=>	'required|numeric',
			'zona'	=>	'required|exists:zonas,nombre',
			'nick' => 'required|unique:usuarios,nick',
			'password' => 'required',
			'repassword' => 'required|same:password',
			'cargo' => 'required|alpha',
			'nombre'	=>	'required|alpha',
			'apellidoPaterno'	=>	'required|alpha',
			'apellidoMaterno'	=>	'required|alpha',
			'ci'	=>	'required|numeric|digits_between:7,8',
			'telefono'	=>	'required|numeric',
			'direccion'	=>	'required',
			
		);
		$validator=Validator::make($todo,$reglas);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);

		}
		else
		{
			$zona=Zona::where('nombre', '=', Input::get('zona'))->first();
		$farmacia=new Farmacia;
		$farmacia->administradore_id=Session::get('id_administrador');
		$farmacia->zona_id=$zona->id;
		$farmacia->habilitado="no";
		$farmacia->turnohabilitado="no";
		$farmacia->nombre=Input::get('nombre_farmacia');
		$farmacia->telefono= Input::get('telefono_farmacia');
		$farmacia->direccion=Input::get('direccion_farmacia');
		$farmacia->save();
		$geoloca=new Geolocalizacione;
		$geoloca->farmacia_id=$farmacia->id;
		$geoloca->administradore_id=Session::get('id_administrador');
		$geoloca->puntox=Input::get('cx');
		$geoloca->puntoy=Input::get('cy');
		$geoloca->save();

		$usuario=new Usuario;
			$usuario->nick=Input::get('nick');
			$usuario->password=Hash::make(Input::get('password'));
			$usuario->cargo=Input::get('cargo');
			$usuario->save();
			$persona=new Persona;
			$persona->nombre=Input::get('nombre');
			$persona->apellidoPaterno=Input::get('apellidoPaterno');
			$persona->apellidoMaterno=Input::get('apellidoMaterno');
			$persona->ci=Input::get('ci');
			$persona->telefono=Input::get('telefono');
			$persona->direccion=Input::get('direccion');
			$persona->usuario_id=$usuario->id;
			$persona->save();

		$encar=new Encargadofarmacia;
		$encar->usuario_id=$usuario->id;
		$encar->save();
		
		$farma=Farmacia::find($farmacia->id);
		$farma->encargadofarmacia_id=$encar->id;
		$farma->habilitado="si";
		$farma->save();
			

		return Redirect::route('farmacia.show',array($farmacia->id));
		}

		

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$farmacia=Farmacia::find($id);
		$geolocalizacion=Farmacia::find($id)->geolocalizacion;
		$encargado_id=Farmacia::find($farmacia->id)->encargadofarmacia;
		$encargado=Encargadofarmacia::find($encargado_id->id)->usuario;
		$zona=Farmacia::find($id)->zona;
		if (is_null($farmacia)) {
			return "no existe";
		}
		return View::make('administrador.farmacias.show',array('farmacia'=>$farmacia,'geolocalizacion'=>$geolocalizacion,'zona'=>$zona,'encargado'=>$encargado));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
			
	 	$farmacia=Farmacia::find($id);
	 	$zonas=Zona::all();
	 	$geolocalizacion=Farmacia::find($id)->geolocalizacion;
		$zonai=Farmacia::find($id)->zona;
		if (is_null($farmacia)) {
			return "No existe!";
		}
		
		return View::make('administrador.farmacias.edit')->with('farmacia',$farmacia)->with('zonas',$zonas)->with('geolocalizacion',$geolocalizacion)->with('zonai',$zonai);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$farmacia=Farmacia::find($id);
		$actual=Input::get('nombre');
		$todo=Input::all();
		if ($farmacia->nombre==$actual)
		{
			$reglas = array(
			'telefono'	=>	'required|numeric',
			'direccion'	=>	'required',
			'cx'	=>	    'required|numeric',
			'cy'	=>	    'required|numeric',
			'zona'	=>	    'required|exists:zonas,nombre',
			
			);
		}
		else
		{
			$reglas = array(
			'nombre'=> 'required|unique:farmacias,nombre',
			'telefono'	=>	'required|numeric',
			'direccion'	=>	'required',
			'cx'	=>	    'required|numeric',
			'cy'	=>	    'required|numeric',
			'zona'	=>	    'required|exists:zonas,nombre',
			
			);
		}
		
		$validator=Validator::make($todo,$reglas);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		else
		{

			
			$geoloca=Farmacia::find($id)->geolocalizacion;
			if (is_null($farmacia)) {
				return "no existe el medicamento";
			}
			$zona=Zona::where('nombre', '=', Input::get('zona'))->first();
			$farmacia->administradore_id=Session::get('id_administrador');
			$farmacia->zona_id=$zona->id;
			$farmacia->nombre=Input::get('nombre');
			$farmacia->telefono= Input::get('telefono');
			$farmacia->direccion=Input::get('direccion');
			$farmacia->save();
			$geoloca->farmacia_id=$farmacia->id;
			$geoloca->administradore_id=Session::get('id_administrador');
			$geoloca->puntox=Input::get('cx');
			$geoloca->puntoy=Input::get('cy');
			$geoloca->save();
			return Redirect::route('farmacia.show',array($farmacia->id));
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$geoloca=Farmacia::find($id)->geolocalizacion;
		$encargado=Farmacia::find($id)->encargadofarmacia;
		$usuaro=Encargadofarmacia::find($encargado->id)->usuario;
		$persona=Usuario::find($usuaro->id)->persona;
		$farmacia=Farmacia::find($id);
		if (count($turnos=Farmacia::find($id)->turnos)!=0) {
			foreach ($turnos as $key) {
				$farmacia->turnos()->detach($key->id);
			}
			 
		}
		Encargadofarmacia::destroy($encargado->id);
		Usuario::destroy($usuaro->id);
		Farmacia::destroy($id);
		Persona::destroy($persona->id);
		Geolocalizacione::destroy($geoloca->id);


		return Redirect::route('farmacia.index');
	}
	public function reportes()
	{
		$zonas=Zona::all();
		return View::make('administrador.farmacias.reportes')->with('zonas',$zonas);
	}
	public function reportefarmaciaporzona()
	{
		$todo=Input::all();
		$reglas = array(
			'zona' => 'exists:zonas,nombre',
			
		);
		$validator=Validator::make($todo,$reglas);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		else
		{
		$zona=Zona::where('nombre','=', Input::get('zona'))->first();
		$farmacias=Zona::find($zona->id)->farmacias;
		$html = View::make('administrador.farmacias.reporteporzona')->with('zona',$zona)->with('farmacias',$farmacias);
    	return PDF::load($html, 'A4', 'portrait')->download('farmacias_por_zona_reporte');
    	//return PDF::load($html, 'A4', 'portrait')->show();
		}
	}
	public function reportefarmaciasgeneral()
	{
		 $farmacias=Farmacia::all();
		 $html = View::make('administrador.farmacias.reportefarmaciasgeneral')->with('farmacias',$farmacias);
    	return PDF::load($html, 'A4', 'portrait')->show();
    	//return PDF::load($html, 'A4', 'portrait')->show();
	}
}
