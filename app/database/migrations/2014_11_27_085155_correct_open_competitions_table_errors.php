<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrectOpenCompetitionsTableErrors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('open_competition_groups', function ($table) {
			$table->dropColumn('open_competition_competitor_id');
			$table->integer('open_competition_id');
		});

		Schema::table('open_competition_competitors', function ($table) {
			$table->integer('open_competition_group_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
