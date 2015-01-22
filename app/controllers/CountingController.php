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
				$gross += ($score->score/* - $score->hole->par*/); // exclude par from counting
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
		usort($res, function ($a, $b) {
			return strcmp($a['score'], $b['score']);
		});
		for($x = 0; $x < count($res); $x++) {
			$res[$x]['rank'] = $x + 1;
		}
		return $res;
	}

	// public function getClosedCompetition($id) {
	// 	$gid = Input::get('group_id');
	// 	$group = ClosedCompetitionGroup::find($gid);
	// 	$data = [];
	// 	$res = [];
	// 	// group scores by party member
	// 	$scores = ClosedCompetitionScore::where('closed_competition_id', '=', $id)
	// 		->where('closed_competition_group_id', '=', $gid)
	// 		->get();
	// 	foreach($scores as $score) {
	// 		if(!isset($data[$score->closed_competition_competitor_id])) {
	// 			$data[$score->closed_competition_competitor_id] = [];
	// 		}
	// 		$data[$score->closed_competition_competitor_id][] = $score;
	// 	}
	// 	// format response
	// 	foreach($data as $key => $s) {
	// 		$ccc = ClosedCompetitionCompetitor::find($key);
	// 		$gross = 0;
	// 		$net = 0;
	// 		// total scores
	// 		foreach($s as $score) {
	// 			$gross += ($score->score/* - $score->hole->par*/);
	// 		}
	// 		$net = $gross - $ccc->member->handicap;
	// 		$res[] = [
	// 			'name' => $ccc->member->firstname . ' ' . $ccc->member->lastname,
	// 			'gross' => $gross,
	// 			'net' => $net
	// 		];
	// 	}
	// 	// sort by net value
	// 	usort($res, function ($a, $b) {
	// 		return strcmp($b['net'], $a['net']);
	// 	});
	// 	/**
	// 	* add rank base on index
	// 	*/
	// 	for($x = 0; $x < count($res); $x++) {
	// 		$res[$x]['rank'] = $x + 1;
	// 	}
	// 	return $res;
	// }

	public function getClosedCompetition($id) { // course id
		$data = [];
		$res = [];
		/**
		* get all groups by course
		*/
		// get all closed competition
		$cc = ClosedCompetition::where('course_id', '=', $id)->get();
		foreach($cc as $c) {
			foreach($c->groups as $group) {
				$scores = ClosedCompetitionScore::where('closed_competition_id', '=', $c->id)
					->where('closed_competition_group_id', '=', $group->id)
					->get();
				foreach($scores as $score) {
					if(!isset($data[$score->closed_competition_competitor_id])) {
						$data[$score->closed_competition_competitor_id] = [];
					}
					$data[$score->closed_competition_competitor_id][] = $score;
				}
			}
		}

		// format response
		foreach($data as $key => $s) {
			$ccc = ClosedCompetitionCompetitor::find($key);
			$gross = 0;
			$net = 0;
			// total scores
			foreach($s as $score) {
				$gross += ($score->score/* - $score->hole->par*/);
			}
			$net = $gross - $ccc->member->handicap;
			$res[] = [
				'name' => $ccc->member->firstname . ' ' . $ccc->member->lastname,
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

}
