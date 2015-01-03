<?php

class ClosedCompetitionGroup extends BaseModel {

	protected $table = 'closed_competition_groups';
	public $timestamps = false;

	public static $relationsData = [
		'competitors' => [self::HAS_MANY,'ClosedCompetitionCompetitor','foreignKey'=>'closed_competition_group_id'],
		'closed_competition' => [self::BELONGS_TO, 'ClosedCompetition', 'foreignKey' => 'closed_competition_id']
	];

	public function toArray(){
		$this->load('competitors', 'closed_competition');
		return parent::toArray();
	}
}
