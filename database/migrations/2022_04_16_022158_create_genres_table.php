<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('genres', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title_category', 200)->nullable();
			$table->string('title_category_eng', 200)->nullable();
			$table->text('no', 65535)->nullable();
			$table->string('type_category', 100)->nullable();
			$table->string('type_source', 100)->nullable();
			$table->string('split', 100)->default('0');
			$table->timestamps();
			$table->text('description', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('genres');
	}

}
