<?php
class Persona extends Eloquent
{
	public function usuario()
	{
			return $this->belongsTo('Usuario');
	}
}