<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ssl')->default(0);
			$table->text('domain', 65535)->nullable();
			$table->text('title', 65535)->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('keyword', 65535)->nullable();
			$table->integer('comment_fb')->nullable()->default(1);
			$table->text('logo', 65535)->nullable();
			$table->text('icon', 65535)->nullable();
			$table->text('facebook', 65535)->nullable();
			$table->text('twitter', 65535)->nullable();
			$table->integer('imdb')->nullable()->default(0);
			$table->integer('time_skip')->default(3);
			$table->string('tmpay', 15)->nullable();
			$table->text('header', 65535)->nullable();
			$table->text('footer', 65535)->nullable();
			$table->text('text_index', 65535)->nullable();
			$table->string('banner_status')->default('1');
			$table->string('last_seo')->default('1');
			$table->timestamps();
			$table->text('streaming_1', 65535)->nullable();
			$table->text('streaming_2', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings');
	}

}
