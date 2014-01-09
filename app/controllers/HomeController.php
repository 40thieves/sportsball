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
			foreach($fixture->teams as $team)
			{
				if ($team->homeTeam)
					$fixture->teams->home = $team;
				else
					$fixture->teams->away = $team;
			}

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

			$fixture->teams->home->goals = isset($goals[$fixture->teams->home->teamID]) ? $goals[$fixture->teams->home->teamID] : 0;
			$fixture->teams->away->goals = isset($goals[$fixture->teams->away->teamID]) ? $goals[$fixture->teams->away->teamID] : 0;

			// Log::debug(print_r($fixture->stadium, true));
		}

		return $this->layout->content = View::make('client', [
			'pusherKey' => Config::get('pusherer::key'),
			'fixtures' => $fixtures,
		]);
	}

	public function trigger()
	{
		Pusherer::trigger('test-channel', 'test-event', array('message' => 'Hello world'));
	}

}