<?php

class ScoreRegistrationController extends BaseController {

	public function getScores($id) {
		// tweak: to change for better implementation
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

	public function getBets($id) {
		$pp = PartyPlay::find($id);
		$scores = PartyPlayBetScore::where('party_play_id', '=', $id)->get();
		$pp->bet_scores = $scores;
		return $pp;
	}

	public function putBet($id = 0) {
		$bet = 0;
		$scores = Input::get('scores');
		if($id == 0) { // not referencing to party play bet
			$bet = PartyPlayBet::where('hole_id', '=', Input::get('hole_id'))
				->where('bet_type_id', '=', Input::get('bet_type_id'))
				->where('party_play_id', '=', Input::get('party_play_id'))
				->first();
		}
		else { // specified a party play bet
			$bet = PartyPlayBet::find($id);
		}
		foreach($scores as $score) {
			$score = (object) $score;
			$bs = new PartyPlayBetScore;
			$bs->party_play_bet_id = $bet->id;
			$bs->party_member_id = $score->party_member_id;
			$bs->party_play_id = $bet->party_play_id;
			$bs->score = $score->score;
			$bs->save();
		}
	}

}
