<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartyPlayScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('party_play_scores', function($table) {
			$table->increments('id');
			$table->integer('score');
			$table->integer('hole_id');
			$table->integer('party_play_id');
			$table->integer('party_member_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('party_play_scores');
	}

}
