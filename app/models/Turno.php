<?php
class Turno extends Eloquent
{
	public function administrador()
	{
		return $this->belongsTo('Administradore');
	}
	public function farmacias()
	{
		return $this->belongsToMany('Farmacia');
	}
}