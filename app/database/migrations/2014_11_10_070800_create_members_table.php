<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function ($table) {
			$table->increments('id');
			$table->string('firstname', 100);
			$table->string('lastname', 100);
			$table->string('email', 120);
			$table->string('password');
			$table->string('gender', 1);
			$table->integer('handicap');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}
