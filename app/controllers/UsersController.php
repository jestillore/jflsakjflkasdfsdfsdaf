<?php

class UsersController extends BaseController {

	public function getProfile() {

		$user = User::find(Authorizer::getResourceOwnerId());
		return $user;

	}

	public function postRegister() {
		$input = Input::all();
		$user = new User;
		$user->firstname = array_get($input, 'firstname');
		$user->lastname = array_get($input, 'lastname');
		$user->email = array_get($input, 'email');
		$user->password = Hash::make(array_get($input, 'password'));
		$user->gender = array_get($input, 'gender');
		$user->handicap = (null !== array_get($input, 'handicap')) ? array_get($input, 'handicap') : 0;
		if($user->save()) { // validate inputs
			return $user;
		}
		return Response::make($user->errors(), 500); // returns error message from validation
	}

	public function putProfile() {
		$user = User::find(Authorizer::getResourceOwnerId()); // get logged in user
		$input = Input::all();
		$user->firstname = array_get($input, 'firstname');
		$user->lastname = array_get($input, 'lastname');
		$user->email = array_get($input, 'email');
		if(!empty(array_get($input, 'password')))
			$user->password = Hash::make(array_get($input, 'password'));
		$user->gender = array_get($input, 'gender');
		$user->handicap = array_get($input, 'handicap');
		if($user->updateUniques()) { // validate inputs
			return $user;
		}
		return Response::make($user->errors(), 500); // returns error message from validation
	}

	public function getAll() {
		return User::all();
	}

}
