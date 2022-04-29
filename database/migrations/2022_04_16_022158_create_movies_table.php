<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMoviesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('title', 65535)->nullable();
			$table->text('slug_title', 65535)->nullable();
			$table->text('new_movie', 65535)->nullable();
			$table->text('type', 65535)->nullable();
			$table->integer('onair')->default(0);
			$table->text('description', 65535)->nullable();
			$table->text('file_main', 65535)->nullable();
			$table->text('file_main_2', 65535)->nullable();
			$table->text('file_main_3', 65535)->nullable();
			$table->text('file_openload', 65535)->nullable();
			$table->text('file_openload_2', 65535)->nullable();
			$table->text('file_openload_3', 65535)->nullable();
			$table->text('file_streamango', 65535)->nullable();
			$table->text('file_streamango_2', 65535)->nullable();
			$table->text('file_streamango_3', 65535)->nullable();
			$table->text('file_main_sub', 65535)->nullable();
			$table->text('file_main_sub_2', 65535)->nullable();
			$table->text('file_main_sub_3', 65535)->nullable();
			$table->text('file_openload_sub', 65535)->nullable();
			$table->text('file_openload_sub_2', 65535)->nullable();
			$table->text('file_openload_sub_3', 65535)->nullable();
			$table->text('file_streamango_sub', 65535)->nullable();
			$table->text('file_streamango_sub_2', 65535)->nullable();
			$table->text('file_streamango_sub_3', 65535)->nullable();
			$table->text('file_series', 65535)->nullable();
			$table->text('youtube', 65535)->nullable();
			$table->string('sound', 20)->nullable();
			$table->text('image', 65535)->nullable();
			$table->text('image_poster', 65535)->nullable();
			$table->text('vip', 65535)->nullable();
			$table->text('runtime', 65535)->nullable();
			$table->text('year', 65535)->nullable();
			$table->text('imdb', 65535)->nullable();
			$table->text('resolution', 65535)->nullable();
			$table->text('view', 65535)->nullable();
			$table->string('api_update')->default('0');
			$table->integer('start_play')->default(0);
			$table->integer('movie_hot')->default(0);
			$table->float('score')->nullable()->default(0.00);
			$table->timestamps();
			$table->text('director', 65535)->nullable();
			$table->text('actors', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movies');
	}

}
