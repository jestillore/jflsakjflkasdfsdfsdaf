<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::controller('oauth', 'OAuthController');

Route::post('login', 'OAuthController@postAccessToken');
Route::post('register', 'UsersController@postRegister');

Route::group(['before' => 'oauth'], function () {
	Route::controller('user', 'UsersController');
	Route::resource('course', 'CoursesController');
	Route::resource('party-play', 'PartyPlayController');
	// open competition
	Route::get('open-competition/competitors', 'OpenCompetitionController@competitors');
	Route::put('open-competition/approve/{id}', 'OpenCompetitionController@approve');
	Route::get('open-competition/{id}/groups', 'OpenCompetitionController@groups');
	Route::post('open-competition/{id}/join', 'OpenCompetitionController@join');
	Route::resource('open-competition', 'OpenCompetitionController');
	// closed competition
	Route::post('closed-competition/{id}/create-group', 'ClosedCompetitionController@createGroup');
	Route::get('closed-competition/group', 'ClosedCompetitionController@groups');
	Route::get('closed-competition/group/mine', 'ClosedCompetitionController@myGroups');
	Route::post('closed-competition/group/{id}/join', 'ClosedCompetitionController@joinGroup');
	Route::delete('closed-competition/group/{id}/leave', 'ClosedCompetitionController@leaveGroup');
	Route::delete('closed-competition/competitor/{id}/kick', 'ClosedCompetitionController@kickMember');
	Route::resource('closed-competition', 'ClosedCompetitionController');
	// party play bet
	Route::controller('bet-registration', 'BetRegistrationController');
	// party play score
	Route::controller('score-registration', 'ScoreRegistrationController');
});
