<?php

class ClosedCompetitionCompetitor extends BaseModel {

	protected $table = 'closed_competition_competitors';
	public $timestamps = false;

	public static $relationsData = [
		'competitors' => [self::HAS_MANY,'ClosedCompetitionCompetitor','foreignKey'=>'closed_competition_group_id']
	];

	public function toArray(){
		$this->load('competitors');
		return parent::toArray();
	}

}
