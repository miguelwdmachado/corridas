<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCorredoresProvasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corredores_provas', function(Blueprint $table)
		{
            $table->integer('id', true);
			$table->integer('corredor_id');
			$table->integer('prova_id');
			$table->string('grupo', 20)->nullable();
			$table->date('data');
			$table->time('h_inicio')->nullable();
			$table->time('h_fim')->nullable();
			$table->time('tempo')->nullable();
			$table->unique(['prova_id','corredor_id'], 'prova_corredor');
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
		Schema::drop('corredores_provas');
	}

}
