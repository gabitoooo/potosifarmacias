<?php
class Encargadofarmacia extends Eloquent
{
	public function usuario()
	{
		return $this->belongsTo('Usuario');
	}
	public function farmacia()
	{
		return $this->hasOne('Farmacia');
	}
}