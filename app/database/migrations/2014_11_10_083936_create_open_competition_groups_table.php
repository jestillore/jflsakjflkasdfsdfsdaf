<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenCompetitionGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('open_competition_groups', function ($table) {
			$table->increments('id');
			$table->integer('handicap');
			$table->string('gender', 1);
			$table->integer('open_competition_competitor_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('open_competition_groups');
	}

}
