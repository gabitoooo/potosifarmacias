<?php
class Medicamentospermisible extends Eloquent
{
	public function farmacias()
	{
		return $this->belongsToMany('Farmacia');
	}
}