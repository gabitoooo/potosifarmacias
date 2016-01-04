<?php

class ZonasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		    $zonas=Zona::orderBy('nombre', 'ASC')->get();

			return View::make('administrador.zonas.list')->with('zonas',$zonas);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('administrador.zonas.store');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$todo=Input::all();
		$reglas=array(
			'nombre'=>'required|unique:zonas,nombre',
			'coordenadas'=>'required',
			);
		$validator=Validator::make($todo,$reglas);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$zona=new Zona;
			$zona->administradore_id=Session::get('id_administrador');
			$zona->nombre=Input::get('nombre');
			$zona->geolocalizacion_zona=Input::get('coordenadas');
			$zona->save();
			return Redirect::route('zona.show',array($zona->id));
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
		$zona=Zona::find($id);
		if (is_null($zona)) {
			return "Esa zona no existe";
		}
		$valor=$zona->geolocalizacion_zona;
		return View::make('administrador.zonas.show')->with('zona',$zona)->with('valor',$valor);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$todo=Input::all();
		$reglas=array(
			'nombre'=>'required|unique:zonas,nombre',
			);
		$validator=Validator::make($todo,$reglas);
		if ($validator->fails()) 
		{
		    return Redirect::back()->withErrors($validator);
		}
		else
		{
			$zona=Zona::find($id);
			$zona->administradore_id=Session::get('id_administrador');
			$zona->nombre=Input::get('nombre');
			$zona->save();
			return Redirect::route('zona.show',array($zona->id));
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
		 Zona::destroy($id);
		 return Redirect::route('zona.index');
	}
	public function reportezonass()
	{
		$zonas=Zona::all();
		$html = View::make('administrador.zonas.reportezonas')->with('zonas',$zonas);
    	 return PDF::load($html, 'A4', 'portrait')->download('zonasreporte');
    	//return PDF::load($html, 'A4', 'portrait')->show();
    	
    			
	}
	public function damezonas()
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
	}


}
