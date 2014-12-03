<?php

class OpenCompetitionController extends BaseController {

	// get all open competitions
	public function index() {
		return OpenCompetition::all();
	}

	// create new open competition
	public function store() {
		$input = Input::all();
		$oc = new OpenCompetition;
		$oc->name = array_get($input, 'name');
		$oc->date = array_get($input, 'date');
		$oc->registration_deadline = array_get($input, 'registration_deadline');
		$oc->course_id = array_get($input, 'course_id');
		$oc->member_id = Authorizer::getResourceOwnerId();
		if($oc->save()) {
			return $oc;
		}
		return Response::make($oc->errors(), 500);
	}

	// view competition
	public function show($id) {
		$oc = OpenCompetition::find($id);
		return $oc;
	}

	// update competition
	public function update($id) {
		$input = Input::all();
		$oc = OpenCompetition::find($id);
		$oc->name = array_get($input, 'name');
		$oc->date = array_get($input, 'date');
		$oc->registration_deadline = array_get($input, 'registration_deadline');
		$oc->course_id = array_get($input, 'course_id');
		if($oc->save()) {
			return $oc;
		}
		return Response::make($oc->errors(), 500);
	}

	// get competition groups
	public function groups($id) {
		$groups = OpenCompetitionGroup::where('open_competition_id', $id)->get();
		return $groups;
	}

	// join competition
	public function join($id) {
		$member = User::find(Authorizer::getResourceOwnerId());
		$group = OpenCompetitionGroup::firstOrCreate([
			'handicap' => $member->handicap,
			'gender' => $member->gender,
			'open_competition_id' => $id
			]);
		$competitor = new OpenCompetitionCompetitor;
		$competitor->approved = false;
		$competitor->open_competition_id = $id;
		$competitor->member_id = Authorizer::getResourceOwnerId();
		$competitor->joined = date('Y-m-d');
		$competitor->open_competition_group_id = $group->id;
		$competitor->save();
	}

	// get competitors of your competition
	public function competitors() {
		$competitions = OpenCompetition::mine()->get(); // get competition of the logged in user
		$competitors = OpenCompetitionCompetitor::fromCompetitions($competitions)->get(); // get competitor each competition
		$data = [];
		foreach($competitors as $competitor) {
			$group = $competitor->group;
			// format open_competition_group to minimize content length
			$competitor->open_competition_group = [
				'id' => $group->id,
	            'handicap' => $group->handicap,
	            'gender' => $group->gender,
			];
			$competition = $competitor->competition;
			// format open_competition to minimize content length
			$competitor->open_competition = [
				'id' => $competition->id,
	            'name' => $competition->name,
	            'date' => $competition->date,
	            'registration_deadline' => $competition->registration_deadline
			];
			$data[] = $competitor;
		}
		return $data;
	}

	// approve competitor
	public function approve($id) {
		$competitor = OpenCompetitionCompetitor::find($id);
		$competitor->approve();
	}

}
