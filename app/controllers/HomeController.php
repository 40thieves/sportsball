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
			// $matchEvents = $fixture->events;
			// foreach($fixture->events as $event)
			// {
			// 	Log::debug(print_r($event->eventType->label, true));
			// }

			foreach($fixture->teams as $team)
			{
				if ($team->homeTeam)
					$fixture->teams->home = $team;
				else
					$fixture->teams->away = $team;
			}

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