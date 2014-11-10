<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClosedCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('closed_competitions', function ($table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->date('date');
			$table->integer('member_id');
			$table->integer('course_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('closed_competitions');
	}

}
