<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearGeolocalozacionTabla extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geolocalizaciones',function($table)
		{
			$table->increments('id');
			$table->integer('farmacia_id');
			$table->integer('administradore_id');
			$table->string('puntox');
			$table->string('puntoy');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('geolocalizaciones');
	}

}
