<?php

class PartyMember extends BaseModel {

	protected $table = 'party_members';
	public $timestamps = false;

	public static $relationsData = [
		'member' => [self::BELONGS_TO, 'User']
	];

	public function toArray() {
		$this->load('member');
		return parent::toArray();
	}

}
