<?php

class OpenCompetitionGroup extends BaseModel {

	protected $table = 'open_competition_groups';
	public $timestamps = false;

	protected $fillable = ['handicap', 'gender', 'open_competition_id'];

	public static $relationsData = [
		'competitors' => [self::HAS_MANY, 'OpenCompetitionCompetitor']
	];

	public function toArray() {
		$this->load('competitors');
		return parent::toArray();
	}

}
