<?php

class ClosedCompetition extends BaseModel {

	protected $table = 'closed_competitions';
	public $timestamps = false;

	public static $relationsData = [
		'course' => [self::BELONGS_TO, 'Course'],
		'groups' => [self::HAS_MANY, 'ClosedCompetitionGroup', 'foreignKey' => 'closed_competition_id']
	];

	public function toArray() {
		$this->load('course');
		return parent::toArray();
	}

}
