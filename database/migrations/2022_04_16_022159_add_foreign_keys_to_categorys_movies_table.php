<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategorysMoviesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categorys_movies', function(Blueprint $table)
		{
			$table->foreign('movie_id')->references('id')->on('movies')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categorys_movies', function(Blueprint $table)
		{
			$table->dropForeign('categorys_movies_movie_id_foreign');
		});
	}

}
