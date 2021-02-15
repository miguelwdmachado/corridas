<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCorredoresProvasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('corredores_provas', function(Blueprint $table)
		{
			$table->foreign('prova_id', 'bk_cp_prova')->references('id')->on('provas')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('corredor_id', 'bk_cp_corredor')->references('id')->on('corredores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('corredores_provas', function(Blueprint $table)
		{
			$table->dropForeign('bk_cp_prova');
			$table->dropForeign('bk_cp_corredor');
		});
	}

}
