<?php

class MedicamentospermisiblesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$medicamentos=Medicamentospermisible::orderBy('nombre', 'ASC')->get();

		return View::make('administrador.medicamentos.list')->with('medicamentos',$medicamentos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('administrador.medicamentos.permisible');
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
			'nombre'	=>	'required|unique:medicamentospermisibles,nombre',
		);
		$validator=Validator::make($todo,$reglas);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		else
		{
		$medicamento=new Medicamentospermisible;
		$medicamento->administradore_id=Session::get('id_administrador');
		$medicamento->nombre=Input::get('nombre');
		$medicamento->save();
		return Redirect::route('permisible.show',array($medicamento->id));	
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
		$medicamento=Medicamentospermisible::find($id);
		if (is_null($medicamento)) {
			return "no existe!";
		}
		return View::make('administrador.medicamentos.show',array('medicamento'=>$medicamento));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$medicamento=Medicamentospermisible::find($id);
		if (is_null($medicamento)) {
			return "No existe!";
		}
		return View::make('administrador.medicamentos.edit')->with('medicamento',$medicamento);
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
		
		if (is_null($medicamento)) {
			return "no existe el medicamento";
		}
		$reglas = array(
			'nombre'	=>	'required|unique:medicamentospermisibles,nombre',
		);
		$validator=Validator::make($todo,$reglas);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		else
		{
		$medicamento=Medicamentospermisible::find($id);
		$medicamento->administradore_id=Session::get('id_administrador');
		$medicamento->nombre=Input::get('nombre');
		$medicamento->save();
		return Redirect::route('permisible.show',array($medicamento->id));
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
		Medicamentospermisible::destroy($id);
		return Redirect::route('permisible.index');
	}


}
