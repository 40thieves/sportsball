<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $layout = 'layouts.master';

	public function showClient()
	{
		$fixtures = Fixture::getAllOngoing();

		foreach($fixtures as $fixture)
		{
			$fixture->load('homeTeam.teamDetails', 'awayTeam.teamDetails');
			$fixture->load('events.eventType', 'events.player');
			$fixture->load('stadium');

			$goals = [];
			foreach($fixture->events as $event)
			{
				// Goals
				if ($event->eventID == 1)
				{
					if ( ! isset($goals[$event->teamID]))
						$goals[$event->teamID] = 1;
					else
						$goals[$event->teamID]++;
				}
			}

			$fixture->homeTeam->goals = isset($goals[$fixture->homeTeam->teamID]) ? $goals[$fixture->homeTeam->teamID] : 0;
			$fixture->awayTeam->goals = isset($goals[$fixture->awayTeam->teamID]) ? $goals[$fixture->awayTeam->teamID] : 0;
		}

		return $this->layout->content = View::make('client', [
			'pusherKey' => Config::get('pusherer::key'),
			'fixtures' => $fixtures,
		]);
	}

	public function trigger()
	{
		$events = EventType::all();
		$fixtures = Fixture::getAllOngoing();

		foreach ($fixtures as $fixture) {
			$fixture->load('homeTeam.teamDetails','awayTeam.teamDetails');
		}

		return $this->layout->content = View::make('trigger',[
			'pusherKey' => Config::get('pusherer::key'),
			'fixtures' => $fixtures,
			'events' => $events
		]);
		// Pusherer::trigger('test-channel', 'test-event', array('message' => 'Hello world'));
	}

	public function twitter()
	{
		return $this->layout->content = View::make('twitter');
	}

}