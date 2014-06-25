<?php

class ApiFixtureController extends ApiController {

	public static function getAll()
	{
		return Fixture::getAllOngoing();
	}

	public static function getSingle($id)
	{
		return Fixture::getSingleOngoing($id);
	}

	public static function getScore($id)
	{
		return Fixture::getSingleOngoingGoals($id);
	}

	public static function getTeams($id)
	{
		return Fixture::getSingleOngoingTeams($id);
	}

	public static function getStadium($id)
	{
		return Fixture::getSingleOngoingStadium($id);
	}

	public static function startMatch($id)
	{
		return Fixture::startMatch($id);
	}

	public static function endMatch($id)
	{
		return Fixture::endMatch($id);
	}

}