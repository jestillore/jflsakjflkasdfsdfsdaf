<?php

class OpenCompetition extends BaseModel {

	protected $table = 'open_competitions';
	public $timestamps = false;

	public static $relationsData = [
		'course' => [self::BELONGS_TO, 'Course']
	];

	public function toArray() {
		$this->load('course');
		$this->joined = $this->iAmCompetitor();
		return parent::toArray();
	}

	public function scopeMine($query) {
        return $query->where('member_id', '=', Authorizer::getResourceOwnerId());
    }

    public function scopeIAmCompetitor($query) {
    	return OpenCompetitionCompetitor::where('open_competition_id', '=', $this->id)
    		->where('member_id', Authorizer::getResourceOwnerId())->count() > 0;
    }

}
