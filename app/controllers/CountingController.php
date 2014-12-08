<?php

class CountingController extends BaseController {

	public function getPartyPlay($id) {
		$pp = PartyPlay::find($id);
		$data = [];
		$res = [];
		foreach($pp->scores as $score) {
			if(!isset($data[$score->party_member_id])) {
				$data[$score->party_member_id] = [];
			}
			$data[$score->party_member_id][] = $score;
		}
		foreach($data as $key => $scores) {
			$pm = PartyMember::find($key);
			$gross = 0;
			$net = 0;
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

}
