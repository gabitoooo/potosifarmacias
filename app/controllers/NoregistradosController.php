<?php

class NoregistradosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$zonas=Zona::orderBy('nombre','ASC')->get();
		$medicamentos=Medicamentospermisible::orderBy('nombre','ASC')->get();
		$farmacias=Farmacia::orderBy('nombre','ASC')->get();
		return View::make('usuariosnoregistrado.index')->with('zonas',$zonas)->with('medicamentos',$medicamentos)->with('farmacias',$farmacias);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function iniciofarmacias()
	{
		if (Request::ajax())
		{
			date_default_timezone_set('America/La_Paz');
    		$hora=date('H');
			$cntrol=true;
			if ($hora==22 || $hora==23)
			{
				$cntrol=false;
			}
			if ($hora<9 )
			{
				$cntrol=false;
			}
			if ($cntrol==true)
			{
				$farmacias=Farmacia::all();
				 for ($i=0; $i <count($farmacias) ; $i++) {
					$geolocalizacion=Farmacia::find($farmacias[$i]->id)->geolocalizacion; 
					$array[$i]=array("nombre"=>$farmacias[$i]->nombre,
						"telefono"=>$farmacias[$i]->telefono,
						"direccion"=>$farmacias[$i]->direccion,
						"puntox"=>$geolocalizacion->puntox,
					    "puntoy"=>$geolocalizacion->puntoy);
					}
					echo json_encode($array);
			}
			else
			{
				$fec = date ( 'Y-m-j');
				$turno=Turno::where('fechaturno','=',$fec)->first();
				$farmacias=Turno::find($turno->id)->farmacias;
				 for ($i=0; $i <count($farmacias) ; $i++) {
					$geolocalizacion=Farmacia::find($farmacias[$i]->id)->geolocalizacion; 
					$array[$i]=array("nombre"=>$farmacias[$i]->nombre,
						"telefono"=>$farmacias[$i]->telefono,
						"direccion"=>$farmacias[$i]->direccion,
						"puntox"=>$geolocalizacion->puntox,
					    "puntoy"=>$geolocalizacion->puntoy);
					}
					echo json_encode($array);

			}
		}		
	}

	public function damefarmacias()
	{
		if (Request::ajax()) {
				$farmacias=Farmacia::all();
				 for ($i=0; $i <count($farmacias) ; $i++) {
					$geolocalizacion=Farmacia::find($farmacias[$i]->id)->geolocalizacion; 
					$array[$i]=array("nombre"=>$farmacias[$i]->nombre,
						"telefono"=>$farmacias[$i]->telefono,
						"direccion"=>$farmacias[$i]->direccion,
						"puntox"=>$geolocalizacion->puntox,
					    "puntoy"=>$geolocalizacion->puntoy);
					}
					echo json_encode($array);
				}
	}

	public function damefarmaciasporturno()
	{
		if (Request::ajax())
		{
			$fec = date ( 'Y-m-j');
			$fechaa=Turno::where('fechaturno','=',$fec)->first();
			$farmacias=Turno::find($fechaa->id)->farmacias;
			for ($i=0; $i <count($farmacias) ; $i++) { 
				$geolocalizacion=Farmacia::find($farmacias[$i]->id)->geolocalizacion;
					$array[$i]=array("nombre"=>$farmacias[$i]->nombre,
						"telefono"=>$farmacias[$i]->telefono,
						"direccion"=>$farmacias[$i]->direccion,
						"puntox"=>$geolocalizacion->puntox,
					    "puntoy"=>$geolocalizacion->puntoy);
			}
				echo json_encode($array);
     	}
	}
 }
	

	



