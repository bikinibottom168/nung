<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('seo_title', 65535)->nullable();
			$table->text('seo_description_type', 65535)->nullable();
			$table->text('front_seo', 65535)->nullable();
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
		Schema::drop('seos');
	}

}
