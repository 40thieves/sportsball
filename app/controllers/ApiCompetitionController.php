<?php

class ApiCompetitionController extends ApiController {

	public static function get()
	{
		return Competition::get();
	}

	public static function getSingle($id)
	{
		return FixtureEvent::getSingleOngoing($id);
	}

	public static function postIndex()
	{
		FixtureEvent::observe(new FixtureEventObserver);

		return FixtureEvent::createSingle();
	}

}