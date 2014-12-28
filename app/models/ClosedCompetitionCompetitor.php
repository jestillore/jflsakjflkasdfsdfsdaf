<?php

class ClosedCompetitionCompetitor extends BaseModel {

	protected $table = 'closed_competition_competitors';
	public $timestamps = false;

	public static $relationsData = [
		'member' => [self::BELONGS_TO, 'User','foreignKey' => 'member_id']
	];

	public function toArray(){
		$this->load('member');
		return parent::toArray();
	}

	

}
