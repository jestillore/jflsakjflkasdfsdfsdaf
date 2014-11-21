<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClosedCompetitionScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('closed_competition_scores', function ($table) {
			$table->increments('id');
			$table->integer('score');
			$table->integer('closed_competition_competitor_id');
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
		Schema::drop('closed_competition_scores');
	}

}
