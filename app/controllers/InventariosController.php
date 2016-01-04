<?php

class InventariosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$fechahoy = date("Y-m-j");
		$fecha=Turno::where('fechaturno','=',$fechahoy)->first();
		if (count($turnoo=Turno::all())!=0)
		{
			$farmacias=Turno::find($fecha->id)->farmacias;
			$mensaje="no esta de Turno";
			foreach ($farmacias as $key) {
				if ($key->id==Session::get('farmacia_id')) {
					$mensaje="Esta de turno";
	      		}
			}
			return View::make('farmacia.inicio')->with('mensaje',$mensaje)->with('fechahoy',$fechahoy);
		}
		else
		{
			$mensaje="no esta de Turno";
			return View::make('farmacia.inicio')->with('mensaje',$mensaje)->with('fechahoy',$fechahoy);
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$medicamentos=Farmacia::find(Session::get('farmacia_id'))->medicamentospermisibles;
		$todomedicamentos=Medicamentospermisible::all();
		$permitidos=array();
		$cierto=false;
		for($i=0;$i<count($todomedicamentos);$i++)
		{
				
				for($j=0;$j<count($medicamentos);$j++)
				{
						if ($medicamentos[$j]->id==$todomedicamentos[$i]->id)
						{
							$cierto=true;
							break;
						}
				}
				if ($cierto==false)
				{
					$permitidos[$i] = $todomedicamentos[$i]->nombre;
	     		}
	     		$cierto=false;
		}	
		return View::make('farmacia.store')->with('permitidos',$permitidos);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
		
			if (Input::get('permitido')=="")
			{
				echo "vacio";
				
			}
			else
			{
				$medicamento;
			if (count($existemedicamento=Medicamentospermisible::where('nombre','=',Input::get('permitido'))->first())==0)
				{
					$medicamento=new Medicamentospermisible;
					$medicamento->nombre=Input::get('permitido');
					$medicamento->save();
					$farmacia=Farmacia::find(Session::get('farmacia_id'));
					$farmacia->medicamentospermisibles()->attach($medicamento);
					return Redirect::to('listar');
				}
				else
				{
					$medicamento=Medicamentospermisible::where('nombre','=',Input::get('permitido'))->first();
					$medicamentos=Farmacia::find(Session::get('farmacia_id'))->medicamentospermisibles;
					$verdad=false;
					for ($i=0; $i <count($medicamentos) ; $i++) { 
						if ($medicamento->id==$medicamentos[$i]->id)
						{
							$verdad=true;
						}
					}
					if ($verdad==false)
					{
						$farmacia=Farmacia::find(Session::get('farmacia_id'));
						$farmacia->medicamentospermisibles()->attach($medicamento);
						return Redirect::to('listar');
					}
					else
					{
						$error="El medicamento ".$medicamento->nombre." ya existe en nuestro inventario";
						return View::make('farmacia.errores')->with('error',$error);
					}

				}
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
		$farmacia=Farmacia::find(Session::get('farmacia_id'));
		$medicamento=Medicamentospermisible::find($id);
		$farmacia->medicamentospermisibles()->detach($medicamento);
		return Redirect::to('listar');
	}
	public function listar()
	{
		$inventarios=Farmacia::find(Session::get('farmacia_id'))->medicamentospermisibles;
		return View::make('farmacia.list')->with('inventarios',$inventarios);
	}
	public function reportemedicamentos()
	{
		$medicamentos=Farmacia::find(Session::get('farmacia_id'))->medicamentospermisibles;
		$html = View::make('farmacia.reportemedicamentos')->with('medicamentos',$medicamentos);
    	return PDF::load($html, 'A4', 'portrait')->download('medicamentosReporte');
    	//return View::make('farmacia.reportemedicamentos')->with('medicamentos',$medicamentos);
	}
	public function reporteturnos()
	{
		$turnos=Farmacia::find(Session::get('farmacia_id'))->turnos;
		$html = View::make('farmacia.reporteturnos')->with('turnos',$turnos);
    	return PDF::load($html, 'A4', 'portrait')->download('turnos del año');
	}
    public function cambio()
    {	
    	$usuario=Usuario::find(Session::get('usuario_id'));
    	return View::make('farmacia.contrasena')->with('usuario',$usuario);
    }
    public function actualizarcon()
    {
    	$user=Usuario::find(Session::get('usuario_id'));
    	$todo=Input::all();
    	$reglas = array(
			'apasword' => 'required',
			'npasword' => 'required',
			'Rpassword' => 'required|same:npasword',
		);
		$validator=Validator::make($todo,$reglas);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$nick=$user->nick;
			$password=Input::get('apasword');
			$usuario=Usuario::where('nick','=',$nick)->first();
			if ($nick==$usuario->nick)
			{
				if (Hash::check($password, $usuario->password))
				{
					$user->password=Hash::make(Input::get('npasword'));	
					$user->save();
					return Redirect::route('farma.index');	
				}
				else
				{

					$reglas=array(
						'apasword'	=>	'el_password_no_es_correcto',
					);
					$validator=Validator::make($todo,$reglas);
					if ($validator->fails()) {
						return Redirect::back()->withErrors($validator);
					}
				}
			}


    }
}

}
