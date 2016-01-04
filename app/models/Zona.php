<?php
class Zona extends Eloquent
{
		public function administrador()
		{
			return $this->belongsTo('Administradore','administradore_id');
		}
		public function farmacias()
		{
			return $this->hasMany('Farmacia');
		}
}