<?php

class ClosedCompetitionScore extends BaseModel {

	protected $table = 'closed_competition_scores';
	public $timestamps = false;

	protected $fillable = ['closed_competition_id', 'closed_competition_group_id', 'hole_id', 'closed_competition_competitor_id'];

	public static $relationsData = [
		'hole' => [self::BELONGS_TO, 'Hole', 'foreignKey' => 'hole_id']
	];

}
