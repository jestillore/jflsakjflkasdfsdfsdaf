<?php

class PartyPlayBetScore extends BaseModel {

	protected $table = 'party_play_bet_scores';
	public $timestamps = false;

	public static $relationsData = [
		'party_member' => [self::BELONGS_TO, 'PartyMember'],
		'party_play_bet' => [self::BELONGS_TO, 'PartyPlayBet']
	];

	public function toArray() {
		$this->load('party_play_bet');
		return parent::toArray();
	}

}
