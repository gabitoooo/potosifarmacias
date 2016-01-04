<?php

class UsuariosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$usuarios=Usuario::orderBy('nick', 'ASC')->get();

		return View::make('administrador.usuarios.list')->with('usuarios',$usuarios);
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		 	
		 	$farmacias=Farmacia::where('habilitado','=','no')->get();
			return View::make('administrador.usuarios.store')->with('farmacias',$farmacias);
	 		 	
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
			'nick' => 'required|unique:usuarios,nick|alpha_num',
			'password' => 'required|alpha_num',
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

			if ($usuario->cargo=="administrador")
			{
				$admin=new Administradore;
				$admin->usuario_id=$usuario->id;
				$admin->save();
				
			}
			return Redirect::route('usuario.show',array($usuario->id));
			
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
		$usuario=Usuario::find($id);
		if (is_null($usuario)) {
			return "no existe!";
		}
		$persona=Usuario::find($id)->persona;
		if ($usuario->cargo=="administrador")
		{
		
			$cargo=Usuario::find($id)->administrador;
			return View::make('administrador.usuarios.show',array('usuario'=>$usuario,'persona'=>$persona,'cargo'=>$cargo));
		}
		elseif ($usuario->cargo=="farmacia") {
			$cargo=Usuario::find($id)->encargadofarmacia;
			$farmacia=Encargadofarmacia::find($cargo->id)->farmacia;
			return View::make('administrador.usuarios.show',array('usuario'=>$usuario,'persona'=>$persona,'cargo'=>$cargo,'farmacia'=>$farmacia));
		}
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$usuario=Usuario::find($id);
		$farmacias=Farmacia::where('habilitado','=','no')->get();
		if (is_null($usuario)) {
			return "No existe!";
		}
		$persona=Usuario::find($id)->persona;
		if ($usuario->cargo=="administrador")
		{
		
			$cargo=Usuario::find($id)->administrador;
			$farmacia=' ';
			return View::make('administrador.usuarios.edit',array('usuario'=>$usuario,'persona'=>$persona,'cargo'=>$cargo,'farmacias'=>$farmacias,'farmacia'=>$farmacia));
		}
		elseif ($usuario->cargo=="farmacia") {
			$cargo=Usuario::find($id)->encargadofarmacia;
			$farmacia=Encargadofarmacia::find($cargo->id)->farmacia;
			return View::make('administrador.usuarios.edit',array('usuario'=>$usuario,'persona'=>$persona,'cargo'=>$cargo,'farmacia'=>$farmacia,'farmacias'=>$farmacias));
		}

		
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
		$reglas = array(
			'password' => 'required',
			'repassword' => 'required|same:password',
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
			$usuario=Usuario::find($id);
   			$usuario->password=Hash::make(Input::get('password'));
			$usuario->save();
			$persona=Persona::where('usuario_id','=',$usuario->id)->first();
			$persona->nombre=Input::get('nombre');
			$persona->apellidoPaterno=Input::get('apellidoPaterno');
			$persona->apellidoMaterno=Input::get('apellidoMaterno');
			$persona->ci=Input::get('ci');
			$persona->telefono=Input::get('telefono');
			$persona->direccion=Input::get('direccion');
			$persona->save();
			return Redirect::route('usuario.show',array($usuario->id));
			
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
		$usuario=Usuario::find($id);
		if ($usuario->cargo=="administrador")
		{
			$admi=Usuario::find($usuario->id)->administrador;
			Administradore::destroy($admi->id);
		}
		else
		{

			$encargado=Usuario::find($id)->encargadofarmacia;
			$farmacia=Farmacia::where('encargadofarmacia_id','=',$encargado->id)->first();
			$farmacia->habilitado="no";
			$farmacia->save();
			Encargadofarmacia::destroy($encargado->id);

			
		}
		$persona=Usuario::find($id)->persona;
		Persona::destroy($persona->id);
		Usuario::destroy($usuario->id);
		return Redirect::route('usuario.index');		
	}
	public function get_login()
	{
		if(Usuario::estaLogeado())
		{
			if (Usuario::esAdministrador())
			 {
				return Redirect::route('admin.index');	
			 }
			elseif (Usuario::esFarmacia()) 
			{
				return Redirect::route('farma.index');
			}
		}
			
		else
			return View::make('usuarios.login');
	}
	public function controlar_ingreso()
	{
		$ingreso=Input::all();
		$reglas=array(
			'nick'		=> 'required|exists:usuarios,nick',
			'password'	=>	'required',
		);
		$validator=Validator::make($ingreso,$reglas);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$nick=Input::get('nick');
			$password=Input::get('password');
			$usuario=Usuario::where('nick','=',$nick)->first();
			if ($nick==$usuario->nick)
			{
				if (Hash::check($password, $usuario->password))
				{
									
					if ($usuario->cargo=='administrador') {
						$administrador=Usuario::find($usuario->id)->administrador;
	   					Session::put('usuario_id',$usuario->id);
						Session::put('usuario_nick',$usuario->nick);
						Session::put('usuario_cargo',$usuario->cargo);
						Session::put('id_administrador',$administrador->id);
						return Redirect::route('admin.index');
					}
					elseif ($usuario->cargo=='farmacia')
					{
						$encargado=Usuario::find($usuario->id)->encargadofarmacia;
	   					$farmacia=Encargadofarmacia::find($encargado->id)->farmacia;
	   					Session::put('usuario_id',$usuario->id);
						Session::put('usuario_nick',$usuario->nick);
						Session::put('usuario_cargo',$usuario->cargo);
						Session::put('id_encargadofarmacia',$encargado->id);
						Session::put('farmacia',$farmacia->nombre);
						Session::put('farmacia_id',$farmacia->id);
						return Redirect::route('farma.index');
					}
					
					

				}
				else
				{

					$reglas=array(
						'password'	=>	'el_password_no_es_correcto',
					);
					$validator=Validator::make($ingreso,$reglas);
					if ($validator->fails()) {
						return Redirect::back()->withErrors($validator);
					}
				}
			}
			else
			{
				return Redirect::to('/login');
			}
		}
	}
	public function cerrarsession()
	{
		Session::flush();
		return Redirect::to('/');
	} 

	public function reportegeneralusuarios()
	{
		$usuarios=Usuario::all();
		$html = View::make('administrador.usuarios.reporteusuarios')->with('usuarios',$usuarios);
    	 return PDF::load($html, 'A4', 'portrait')->download('usuariosreportes');
    	//return PDF::download($html, 'A4', 'portrait')->show();
		
		//return View::make('administrador.usuarios.reporteusuarios')->with('usuarios',$usuarios);
	}

}
