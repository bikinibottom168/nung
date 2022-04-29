<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategorysMoviesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorys_movies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('movie_id')->unsigned()->nullable()->default(1)->index('categorys_movies_movie_id_foreign');
			$table->integer('category_id')->nullable()->default(1);
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
		Schema::drop('categorys_movies');
	}

}
