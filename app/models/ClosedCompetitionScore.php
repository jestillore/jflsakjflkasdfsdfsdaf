<?php

class ClosedCompetitionScore extends BaseModel {

	protected $table = 'closed_competition_scores';
	public $timestamps = false;

	protected $fillable = ['closed_competition_id', 'closed_competition_group_id', 'hole_id', 'closed_competition_competitor_id'];

}
