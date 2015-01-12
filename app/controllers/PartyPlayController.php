<?php

class PartyPlayController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return PartyPlay::all();
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
		$userId = Authorizer::getResourceOwnerId();
		$pp = new PartyPlay;
		$pp->name = array_get($input, 'name');
		$pp->date = array_get($input, 'date');
		$pp->course_id = array_get($input, 'course_id');
		$pp->member_id = $userId;
		if($pp->save()) {
			if(!empty(array_get($input, 'members'))) {
				foreach(array_get($input, 'members') as $m) {
					$member = new PartyMember;
					$member->party_play_id = $pp->id;
					$member->member_id = $m['member_id'];
					$member->save();
					$member->member->handicap = $m['handicap'];
					$member->member->updateUniques();
				}
			}
			return $pp;
		}
		return Response::make($pp->errors(), 500);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pp = PartyPlay::find($id);
		return $pp;
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
		$pp = PartyPlay::find($id);
		$pp->name = array_get($input, 'name');
		$pp->date = array_get($input, 'date');
		$pp->course_id = array_get($input, 'course_id');
		if($pp->save()) {
			PartyMember::where('party_play_id', '=', $pp->id)->delete();
			if(!empty(array_get($input, 'members'))) {
				foreach(array_get($input, 'members') as $m) {
					$member = new PartyMember;
					$member->party_play_id = $pp->id;
					$member->member_id = $m;
					$member->save();
				}
			}
			return $pp;
		}
		return Response::make($pp->errors(), 500);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PartyPlay::destroy($id);
	}


}
