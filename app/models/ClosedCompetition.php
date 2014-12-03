<?php

class ClosedCompetition extends BaseModel {

	protected $table = 'closed_competitions';
	public $timestamps = false;

	public static $relationsData = [
		'course' => [self::BELONGS_TO, 'Course']
	];

	public function toArray() {
		$this->load('course');
		return parent::toArray();
	}

}
