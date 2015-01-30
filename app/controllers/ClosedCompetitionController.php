<?php

class ClosedCompetitionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return ClosedCompetition::all();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$cc = new ClosedCompetition;
		$cc->name = array_get($input, 'name');
		$cc->date = array_get($input, 'date');
		$cc->member_id = Authorizer::getResourceOwnerId();
		$cc->course_id = array_get($input, 'course_id');
		if($cc->save()) {
			return $cc;
		}
		return Response::make($cc->errors(), 500);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cc = ClosedCompetition::find($id);
		return $cc;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$cc = ClosedCompetition::find($id);
		$cc->name = array_get($input, 'name');
		$cc->date = array_get($input, 'date');
		$cc->course_id = array_get($input, 'course_id');
		if($cc->save()) {
			return $cc;
		}
		return Response::make($cc->errors(), 500);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	/**
	* @POST
	* Create group for the competition
	*/
	public function createGroup($id) {
		$input = Input::all();
		$cg = new ClosedCompetitionGroup;
		$cg->name = array_get($input, 'name');
		$cg->closed_competition_id = $id;
		$cg->member_id = Authorizer::getResourceOwnerId();
		if($cg->save()) {
			foreach(array_get($input, 'members') as $member) {
				$competitor = new ClosedCompetitionCompetitor;
				$competitor->closed_competition_id = $cg->closed_competition_id;
				$competitor->member_id = $member;
				$competitor->closed_competition_group_id = $cg->id;
				$competitor->joined = date('Y-m-d h:i:s');
				$competitor->save();
			}
			return $cg;
		}
		return Response::make($cg->errors(), 500);
	}

	/**
	* @GET
	* Update group
	*/
	// public function updateGroup($c, $g) {
	// 	$group = ClosedCompetitionGroup::find($g);
	// 	$group->name = Input::get('name');
	// 	$group->save();
	// 	return $group;
	// }

	/**
	* @GET
	* Get all groups
	* /closed-competition/group
	*/
	public function groups() {
		$groups = ClosedCompetitionGroup::all();
		return $groups;
	}

	/**
	* @GET
	* Get my groups
	* /closed-competition/group/mine
	*/
	public function myGroups() {
		$groups = ClosedCompetitionGroup::where('member_id', '=', Authorizer::getResourceOwnerId())->get();
		// $groups = ClosedCompetitionGroup::where('')
		return $groups;
	}

	/**
	* @POST
	* Join group
	* /closed-competition/group/{id}/join
	*/
	public function joinGroup($id) {
		// add to competitors table
		$cg = ClosedCompetitionGroup::find($id);
		$competitor = new ClosedCompetitionCompetitor;
		$competitor->closed_competition_id = $cg->closed_competition_id;
		$competitor->member_id = Authorizer::getResourceOwnerId();
		$competitor->closed_competition_group_id = $id;
		$competitor->joined = date('Y-m-d h:i:s');
		if($competitor->save()) {
			return $competitor;
		}
		return Response::make($competitor->errors(), 500);
	}

	/**
	* @DELETE
	* Leave group
	* /closed-competition/group/{id}/leave
	*/
	public function leaveGroup($id) {
		// remove from competitors table
		ClosedCompetitionCompetitor::where('member_id', '=', Authorizer::getResourceOwnerId())
			->where('closed_competition_group_id', $id)
			->delete();
	}

	/**
	* @DELETE
	* Kick member
	* /closed-competition/competitor/{id}/kick
	*/
	public function kickMember($id) {
		// remove from competitors table
		ClosedCompetitionCompetitor::destroy($id);
	}

	/**
	* @GET
	* Get groups by competition
	* /closed-competition/{id}/group
	*/
	public function competitionGroups($id) {
		if(ClosedCompetitionCompetitor::where('closed_competition_id', '=', $id)
			->where('member_id', '=', Authorizer::getResourceOwnerId())->count() > 0) {
			App::abort(500);
		}
		$groups = ClosedCompetitionGroup::where('closed_competition_id', '=', $id)->get();
		return $groups;
	}

	public function updateGroup($c,$g){
		$group = ClosedCompetitionGroup::find($g);
		$group->name = Input::get('name');
		$group->closed_competition_id = Input::get('closed_competition_id');

		if ($group->save()) {
			$members = Input::get('members');
			
			if ($members) {	//updates members
				ClosedCompetitionCompetitor::where('closed_competition_group_id', '=', $group->id)->delete();
				
				foreach ($members as $member) {
					$competitor = new ClosedCompetitionCompetitor;
					$competitor->closed_competition_id = $group->closed_competition_id;
					$competitor->member_id =$member;
					$competitor->closed_competition_group_id = $group->id;
					$competitor->joined = date('Y-m-d h:i:s');
					$competitor->save();
				}
			
			}
			
			return $group;
		}

		return Response::make($group->errors(),500);
	}
}
