<?php

class CountingController extends BaseController {

	public function getPartyPlay($id) {
		$pp = PartyPlay::find($id);
		$data = [];
		$res = [];
		// group scores by party member
		foreach($pp->scores as $score) {
			if(!isset($data[$score->party_member_id])) {
				$data[$score->party_member_id] = [];
			}
			$data[$score->party_member_id][] = $score;
		}
		// format response
		foreach($data as $key => $scores) {
			$pm = PartyMember::find($key);
			$gross = 0;
			$net = 0;
			// total scores
			foreach($scores as $score) {
				$gross += ($score->score - $score->hole->par);
			}
			$net = $gross - $pm->member->handicap;
			$res[] = [
				'name' => $pm->member->firstname . ' ' . $pm->member->lastname,
				'gross' => $gross,
				'net' => $net
			];
		}
		// sort by net value
		usort($res, function ($a, $b) {
			return strcmp($a['net'], $b['net']);
		});
		/**
		* add rank base on index
		*/
		for($x = 0; $x < count($res); $x++) {
			$res[$x]['rank'] = $x + 1;
		}
		return $res;
	}

	public function getBet($id) {
		$pp = PartyPlay::find($id);
		$data = [];
		$res = [];
		// group scores by party member
		foreach($pp->bscores as $score) {
			if(!isset($data[$score->party_member_id])) {
				$data[$score->party_member_id] = [];
			}
			$data[$score->party_member_id][] = $score;
		}
		// format response
		foreach($data as $key => $scores) {
			$pm = PartyMember::find($key);
			$score = 0;
			$operand = '+';
			foreach($scores as $s) {
				$score += $s->score;
			}
			if($score < 0) {
				$operand = '-';
				$score *= -1;
			}
			$res[] = [
				'name' => $pm->member->firstname . ' ' . $pm->member->lastname,
				'operand' => $operand,
				'score' => $score
			];
		}
		return $res;
	}

}
