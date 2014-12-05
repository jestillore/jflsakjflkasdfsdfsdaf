<?php

class PartyPlayBet extends BaseModel {

	protected $table = 'party_play_bets';
	public $timestamps = false;

	protected $fillable = ['party_play_id', 'hole_id'];

	public static $relationsData = [
		'bet_type' => [self::BELONGS_TO, 'BetType']
	];

	public function toArray() {
		$this->load('bet_type');
		return parent::toArray();
	}

}
