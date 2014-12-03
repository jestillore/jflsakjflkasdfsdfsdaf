<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOpenCompetitorsErrors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('closed_competition_groups', function ($table) {
			$table->string('name');
			$table->integer('member_id');
		});
		Schema::table('closed_competition_competitors', function ($table) {
			$table->integer('closed_competition_group_id');
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
