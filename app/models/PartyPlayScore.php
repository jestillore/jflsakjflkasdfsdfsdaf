<?php

class PartyPlayScore extends BaseModel {

	protected $table = 'party_play_scores';
	public $timestamps = false;

	protected $fillable = ['party_play_id', 'party_member_id', 'hole_id'];

}
