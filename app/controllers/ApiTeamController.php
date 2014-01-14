<?php

class ApiTeamController extends ApiController {

	// public static function getAll()
	// {
	// 	return Fixture::getAllOngoing();
	// }

	// public static function getSingle($id)
	// {
	// 	return Fixture::getSingleOngoing($id);
	// }

	public static function getPlayers($id) 
	{
		return Team::getPlayers($id);
	}
}