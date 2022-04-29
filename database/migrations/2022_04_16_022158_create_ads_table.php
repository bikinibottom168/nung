<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('title_ads', 65535)->nullable();
			$table->text('count_click', 65535)->nullable();
			$table->text('show_ads', 65535)->nullable();
			$table->text('position', 65535)->nullable();
			$table->text('url_ads', 65535)->nullable();
			$table->text('status_button', 65535)->nullable();
			$table->text('image_ads', 65535)->nullable();
			$table->string('layout_ads', 10)->nullable();
			$table->integer('status_ads')->default(0);
			$table->string('number_ads', 10)->default('0');
			$table->text('expired', 65535)->nullable();
			$table->text('button', 65535)->nullable();
			$table->text('type', 65535)->nullable();
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
		Schema::drop('ads');
	}

}
