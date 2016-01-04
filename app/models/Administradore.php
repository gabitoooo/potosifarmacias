<?php
class Administradore extends Eloquent
{
	public function usuario()
	{
		return $this->belongsTo('Usuario');
	}
	public function farmacias()
	{
		return $this->hasMany('Farmacia');
	}
	public function zonas()
	{
		return $this->hasMany('Zona');
	}
	public function turnos()
	{
		return $this->hasMany('Turno');
	}
	public function geolocalizaciones()
	{
		return $this->hasMany('Geolocalizacione');
	}
}
