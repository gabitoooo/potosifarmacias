<?php
class Usuario extends Eloquent
{
	public static function estaLogeado()//esta funcon comprueba si el usuario esta logeado
	{
		if(Session::has('usuario_id'))//si lo esta devuelve verdadero
			return true;
		else
			return false;//si no devuelve falso
	}

	public static function esAdministrador()
	{
		if(Session::get('usuario_cargo') == 'administrador')
			return true;
		else
			return false;
	}
	public static function esFarmacia()
	{
		if (Session::get('usuario_cargo') == 'farmacia')
			return true;
		else
			return false;
	}

	public function persona()
	{
		return $this->hasOne('Persona');
	}
	public function administrador()
	{
		return $this->hasOne('Administradore');
	}
	public function encargadofarmacia()
	{
		return $this->hasOne('Encargadofarmacia');
	}
}