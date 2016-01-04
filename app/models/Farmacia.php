<?php
class Farmacia extends Eloquent
{
	public function encargadofarmacia()
	{
		return $this->belongsTo('Encargadofarmacia');
	}
	public function administrador()
	{
		return $this->belongsTo('Administradore','administradore_id');
	}
	public function geolocalizacion()
	{
		return $this->hasOne('Geolocalizacione');
	}
	public function zona()
	{
		return $this->belongsTo('Zona');
	}
	public function medicamentospermisibles()
	{
		return $this->belongsToMany('Medicamentospermisible');
	}
	public function turnos()
	{
		return $this->belongsToMany('Turno');
	}
}