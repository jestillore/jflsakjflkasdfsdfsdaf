<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenCompetitionCompetitorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('open_competition_competitors', function ($table) {
			$table->increments('id');
			$table->boolean('approved');
			$table->integer('open_competition_id');
			$table->integer('member_id');
			$table->timestamp('joined');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('open_competition_competitors');
	}

}
