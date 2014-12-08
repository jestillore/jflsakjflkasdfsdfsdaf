<?php

class PartyPlay extends BaseModel {

	public $timestamps = false;
	protected $table = 'party_plays';

	public static $relationsData = [
		'course' => [self::BELONGS_TO, 'Course'],
		'owner' => [self::BELONGS_TO, 'User', 'foreignKey' => 'member_id'],
		'members' => [self::HAS_MANY, 'PartyMember'],
		'scores' => [self::HAS_MANY, 'PartyPlayScore']
	];

	public function toArray() {
		$this->load('course', 'members', 'owner');
		return parent::toArray();
	}

}
