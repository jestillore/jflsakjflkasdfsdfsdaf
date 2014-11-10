<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClosedCompetitionCompetitorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('closed_competition_competitors', function ($table) {
			$table->increments('id');
			$table->integer('closed_competition_id');
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
		Schema::drop('closed_competition_competitors');
	}

}
