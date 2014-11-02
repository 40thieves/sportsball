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

Route::model('competition','Competition');

Route::get('/', 'HomeController@showClient');

Route::get('trigger', 'HomeController@trigger');

Route::get('twitter','HomeController@twitter');


Route::group(['prefix' => 'api'], function() {

	Route::group(['prefix' => 'competitions'],function()
	{
		Route::get('/','ApiCompetitionController@get');
		Route::get('{competition}',function(Competition $competition)
        {
            return $competition;
        });
	});

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
		
		Route::get('/','AdminController@showIndex');	

		Route::group(['prefix' => 'angular'],function(){

            App::missing(function($ex){
                return View::make('admin/angular/index');
            });

		});
		
		Route::group(['prefix' => 'fixtures'],function(){

			Route::get('/','AdminController@showFixtures');
			
			Route::group(['prefix' => '{id}'],function(){
				
				Route::get('/','AdminController@showFixtureDetails');
				Route::get('/analysis','AdminController@showFixtureAnalysis');
				
				Route::group(['prefix' => 'facts'],function(){
					Route::get('/','AdminController@showNewFact');
					Route::post('/','AdminController@postNewFact');					
				});
				
			});
			
			Route::get('/new','AdminController@showNewFixture');
			Route::post('/new','AdminController@postNewFixture');

		});

		Route::group(['prefix' => 'teams'],function(){

			Route::get('/','AdminTeamController@showOverview');

			Route::group(['prefix' => 'new'],function(){
				Route::get('/','AdminTeamController@showNew');
				Route::post('/','AdminTeamController@postNew');
			});

			Route::group(['prefix' => '{id}'],function(){
				Route::get('/','AdminTeamController@showSingle');
			});
			
		});

		Route::group(['prefix' => 'competitions'],function(){

			Route::get('/','AdminCompetitionController@showOverview');

			Route::group(['prefix' => 'new'],function(){
				Route::get('/','AdminCompetitionController@showNew');
				Route::post('/','AdminCompetitionController@postNew');
			});

			Route::group(['prefix' => '{id}'],function(){

				Route::get('/','AdminCompetitionController@showSingle');

				Route::group(['prefix' => 'teams'],function(){
					Route::get('/','AdminCompetitionController@showAddNewTeam');					
				});

			});

		});

	});

});

Route::get('login',function(){
	return "Please login";
});

Route::get('register','HomeController@showRegistrationForm');
Route::post('register','UserController@createSingle');
