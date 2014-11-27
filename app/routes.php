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

	Route::get('open-competition/{id}', 'OpenCompetitionController@view');
	Route::get('open-competition/{id}/groups', 'OpenCompetitionController@groups');
	Route::post('open-competition/{id}/join', 'OpenCompetitionController@join');
	Route::controller('open-competition', 'OpenCompetitionController');
});
