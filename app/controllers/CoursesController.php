<?php

class CoursesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Course::all();
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
		$course = new Course;
		$course->name = array_get($input, 'name');
		$course->holes = array_get($input, 'holes');
		$course->active = array_get($input, 'active');
		if($course->save()) {
			foreach(array_get($input, 'holeItems') as $hole) {
				$h = new Hole;
				$h->hole_number = array_get($hole, 'hole_number');
				$h->par = array_get($hole, 'par');
				$h->course_id = $course->id;
				$h->save();
			}
			return Response::make('', 200);
		}
		return Response::make($course->errors(), 500);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$course = Course::find($id);
		return $course;
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
		//
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


}
