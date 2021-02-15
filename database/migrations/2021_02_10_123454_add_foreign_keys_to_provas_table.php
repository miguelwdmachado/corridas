<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProvasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('provas', function(Blueprint $table)
		{
			$table->foreign('tipo_prova_id', 'bk_prova_tipo')->references('id')->on('tipo_prova')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('provas', function(Blueprint $table)
		{
			$table->dropForeign('bk_prova_tipo');
		});
	}

}
