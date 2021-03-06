<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PartyPlay extends BaseModel {

	use SoftDeletingTrait;

	public $timestamps = false;
	protected $table = 'party_plays';
	protected $dates = ['deleted_at'];

	public static $relationsData = [
		'course' => [self::BELONGS_TO, 'Course'],
		'owner' => [self::BELONGS_TO, 'User', 'foreignKey' => 'member_id'],
		'members' => [self::HAS_MANY, 'PartyMember'],
		'bscores' => [self::HAS_MANY, 'PartyPlayBetScore', 'foreignKey' => 'party_play_id'],
		'scores' => [self::HAS_MANY, 'PartyPlayScore'],
		'bets' => [self::HAS_MANY, 'PartyPlayBet', 'foreignKey' => 'party_play_id']
	];

	public function toArray() {
		$this->load('course', 'members', 'owner');
		return parent::toArray();
	}

}
