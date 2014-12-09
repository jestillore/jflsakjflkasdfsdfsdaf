<?php

class PartyPlayBetScore extends BaseModel {

	protected $table = 'party_play_bet_scores';
	public $timestamps = false;

	public static $relationsData = [
		'party_member' => [self::BELONGS_TO, 'PartyMember']
	];

	public function toArray() {
		//$this->load('party_member');
		return parent::toArray();
	}

}
