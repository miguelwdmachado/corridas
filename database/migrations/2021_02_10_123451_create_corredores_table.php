<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCorredoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corredores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 80);
			$table->char('cpf', 14);
			$table->date('dt_nascimento');
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
		Schema::drop('corredores');
	}

}
