<?php

class ApiFixtureController extends ApiController {

	public static function getAll()
	{
		$fixtures = Fixture::getAllOngoing();

		return $fixtures;
	}

	public static function getSingle($id)
	{
		$fixture = Fixture::getSingleOngoing($id);

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

		return $fixture;
	}

	public static function getScore($id)
	{

	}

	public static function getTeams($id)
	{

	}

	public static function getStadium($id)
	{

	}

}