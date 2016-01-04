<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearFarmaciaMedicamentospermisibleTabla extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('farmacia_medicamentospermisible',function($table)
		{
			$table->increments('id');
			$table->integer('farmacia_id');
			$table->integer('medicamentospermisible_id');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('farmacia_medicamentospermisible');
	}

}
