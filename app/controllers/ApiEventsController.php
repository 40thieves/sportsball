<?php

class ApiEventsController extends ApiController {

	public static function getAll()
	{
		return FixtureEvent::getAllOngoing();
	}

	public static function getSingle($id)
	{
		return FixtureEvent::getSingleOngoing($id);
	}

}