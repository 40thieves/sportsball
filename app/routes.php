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

Route::get('/', 'HomeController@showClient');

Route::get('trigger', 'HomeController@trigger');

Route::get('twitter','HomeController@twitter');


Route::group(['prefix' => 'api'], function() {

	Route::get('twitter','TwitterFixtureController@getAll');
	Route::get('mining','TwitterDataMiningController@getAll');

	Route::group(['prefix' => 'fixture'], function() {
		Route::get('/', 'ApiFixtureController@getAll');
		Route::get('start/{id}', 'ApiFixtureController@startMatch');
		Route::get('end/{id}', 'ApiFixtureController@endMatch');
		Route::get('{id}', 'ApiFixtureController@getSingle');
		Route::get('{id}/score', 'ApiFixtureController@getScore');
		Route::get('{id}/teams', 'ApiFixtureController@getTeams');
		Route::get('{id}/stadium', 'ApiFixtureController@getStadium');
	});

	Route::group(['prefix' => 'events'], function() {
		Route::get('/', 'ApiEventsController@getAll');
		Route::get('/{id}', 'ApiEventsController@getSingle');

		Route::post('/', 'ApiEventsController@postIndex');
	});

	Route::group(['prefix' => 'team'], function() {
		Route::get('/','ApiTeamController@getAll');
		Route::get('/{id}','ApiTeamController@getSingle');
		Route::get('/{id}/players','ApiTeamController@getPlayers');

	});
});

Route::group(['before' => 'auth.basic'],function(){
	Route::group(['prefix' => 'admin'],function(){
		Route::get('/',function(){
			return "Hello Admin";
		});		
	});
});

Route::get('login',function(){
	return "Please login";
});

Route::get('register','HomeController@showRegistrationForm');
Route::post('register','UserController@createSingle');
