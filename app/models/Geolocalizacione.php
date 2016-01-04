<?php
class Geolocalizacione extends Eloquent
{
	public function farmacia()
	{
		return $this->belongsTo('Farmacia');
	}
	public function administrador()
	{
		return $this->belongsTo('Administradore');
	}
}