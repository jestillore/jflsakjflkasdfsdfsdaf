<?php

class BetRegistrationController extends BaseController {

	public function putRegister($id) {
		$input = Input::all();
		$holeID = array_get($input, 'hole_id');
		PartyPlayBet::where('party_play_id', '=', $id)
			->where('hole_id', '=', $holeID)
			->delete();
		$bets = array_get($input, 'bets');
		if(is_array($bets)) {
			foreach(array_get($input, 'bets') as $b) {
				$b = (object)$b;
				$bet = new PartyPlayBet;
				$bet->party_play_id = $id;
				$bet->hole_id = $holeID;
				$bet->amount = $b->amount;
				$bet->bet_type_id = $b->bet_type_id;
				$bet->save();
			}
		}
	}

	public function getBets($id) {
		$pp = PartyPlay::find($id);
		/**
		* tweak because of the bug
		*/
		$pp = json_encode($pp);
		$pp = json_decode($pp);
		/**
		* end tweak
		*/
		foreach($pp->course->hole_items as $hole) {
			$bet = PartyPlayBet::where('party_play_id', '=', $id)
				->where('hole_id', '=', $hole->id)->first();
			$hole->bet = $bet;
		}
		$res = json_encode($pp);
		return $res;
	}

}
