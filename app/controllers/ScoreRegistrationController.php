<?php

class ScoreRegistrationController extends BaseController {

	public function getScores($id) {
		$pp = json_encode(PartyPlay::find($id));
		$pp = json_decode($pp);
		foreach($pp->members as $member) {
			$scores = PartyPlayScore::where('party_member_id', '=', $member->id)
				->where('party_play_id', '=', $member->party_play_id)
				->get();
			$member->scores = $scores;
		}
		return json_encode($pp);
	}

	public function putScore($id) {
		$input = Input::all();
		$scores = array_get($input, 'scores');
		if(is_array($scores)) {
			foreach($scores as $score) {
				$score = (object) $score;
				$ps = PartyPlayScore::firstOrNew([
					'party_play_id' => $id,
					'hole_id' => array_get($input, 'hole_id'),
					'party_member_id' => $score->party_member_id
					]);
				$ps->score = $score->score;
				$ps->save();
			}
		}
	}

}
