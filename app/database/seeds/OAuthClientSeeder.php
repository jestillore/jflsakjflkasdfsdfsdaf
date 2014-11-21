<?php

class OAuthClientSeeder extends Seeder {

	public function run() {
		$android = new OAuthClient;
		$android->id = 'GOLFAPP1234';
		$android->secret = 'thequickbrownfox1234';
		$android->name = 'Golf Android App';
		$android->save();
	}

}
