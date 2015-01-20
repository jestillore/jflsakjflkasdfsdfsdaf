<?php

class MembersSeeder extends Seeder {

	public function run() {
		$user1 = new User;
		$user1->firstname = 'Jillberth';
		$user1->lastname = 'Estillore';
		$user1->email = 'ejillberth@gmail.com';
		$user1->password = Hash::make('imc3bu');
		$user1->gender = 'M';
		$user1->handicap = 3;
		$user1->save();

		$user2 = new User;
		$user2->firstname = 'Marian';
		$user2->lastname = 'Rivera';
		$user2->email = 'rmarian@gmail.com';
		$user2->password = Hash::make('imc3bu');
		$user2->gender = 'F';
		$user2->handicap = 3;
		$user2->save();
	}

}