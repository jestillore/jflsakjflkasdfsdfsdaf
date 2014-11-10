<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenCompetitionScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('open_competition_scores', function ($table) {
			$table->increments('id');
			$table->integer('score');
			$table->integer('open_competition_competitor_id');
			$table->integer('hole_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('open_competition_scores');
	}

}
