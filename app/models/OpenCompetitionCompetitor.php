<?php

class OpenCompetitionCompetitor extends BaseModel {

	protected $table = 'open_competition_competitors';
	public $timestamps = false;

	public static $relationsData = [
		'member' => [self::BELONGS_TO, 'User'],
		'group' => [self::BELONGS_TO, 'OpenCompetitionGroup', 'foreignKey' => 'open_competition_group_id'],
		'competition' => [self::BELONGS_TO, 'OpenCompetition','foreignKey' => 'open_competition_id']
	];

	protected $hidden = ['group', 'competition'];

	public function toArray() {
		$this->load('member');
		return parent::toArray();
	}

	public function scopeFromCompetition($query, $competition) {

	}

	public function scopeFromCompetitions($query, $competitions) {
		$ids = array_pluck($competitions, 'id');
		return $query->whereIn('open_competition_id', $ids);
	}

	public function approve() {
		$this->approved = true;
		$this->save();
	}

}
