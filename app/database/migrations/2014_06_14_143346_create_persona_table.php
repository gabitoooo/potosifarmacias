<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personas',function($table)
		{
			$table->increments('id');
			$table->integer('usuario_id');
			$table->string('nombre',20);
			$table->string('apellidoPaterno',20);
			$table->string('apellidoMaterno',20);
			$table->string('ci',7);
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
		Schema::drop('personas');
	}

}
