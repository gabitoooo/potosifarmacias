<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearFarmaciaTabla extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('farmacias',function($table)
		{
			$table->increments('id');
			$table->integer('administradore_id');
			$table->integer('zona_id');
			$table->string('encargadofarmacia_id');
			$table->string('habilitado');
			$table->string('turnohabilitado',10);
			$table->string('nombre',20);
			$table->string('telefono',10);
			$table->string('direccion',50);

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
		Schema::drop('farmacias');
	}

}
