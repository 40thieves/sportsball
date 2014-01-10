<?php

class Fixture extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'fixture';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'fixtureID';

	/**
	 * Turns off automatic timestamps
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * Model attributes that can be mass-assigned
	 * @var array
	 */
	protected $fillable = [
		'stadiumID',
	];

	/**
	 * Model attributes that cannot be mass-assigned
	 * @var array
	 */
	protected $guarded = [
		'fixtureID',
	];

	/**
	 * Model attributes that are hidden from JSON conversion
	 * @var array
	 */
	protected $hidden = [
		'isOngoing',
	];

	public function events()
	{
		return $this->hasMany('FixtureEvent', 'fixtureID');
	}

	public function teams()
	{
		return $this->hasMany('FixtureTeam', 'fixtureID');
	}

	public function homeTeam()
	{
		return $this->hasOne('FixtureTeam', 'fixtureID')->where('homeTeam', '1');
	}

	public function awayTeam()
	{
		return $this->hasOne('FixtureTeam', 'fixtureID')->where('homeTeam', '!=', '1');
	}

	public function stadium()
	{
		return $this->hasOne('Stadium', 'stadiumID');
	}

	protected static function _getOngoingWithTeam()
	{
		return self::where('isOngoing', '1')
			->with('homeTeam.teamDetails')
			->with('awayTeam.teamDetails');
	}

	public static function getAllOngoing()
	{
		return self::_getOngoingWithTeam()->get();
	}

	public static function getSingleOngoing($id)
	{
		$fixture = self::_getOngoingWithTeam()
			->where('fixtureID', $id)
			->with('events.eventType', 'events.player')
			->with('stadium')
			->firstOrFail();

		$goals = self::calculateGoals($fixture->events, $fixture->homeTeam->teamID, $fixture->awayTeam->teamID);
		$fixture->homeTeam->goals = $goals['homeGoals'];
		$fixture->awayTeam->goals = $goals['awayGoals'];

		return $fixture;
	}

	public static function getSingleOngoingGoals($id)
	{
		$fixture = self::_getOngoingWithTeam()
			->where('fixtureID', $id)
			->with('events')
			->firstOrFail();

		$goals = self::calculateGoals($fixture->events, $fixture->homeTeam->teamID, $fixture->awayTeam->teamID);
		$fixture->homeTeam->goals = $goals['homeGoals'];
		$fixture->awayTeam->goals = $goals['awayGoals'];

		return $fixture;
	}

	public static function getSingleOngoingTeams($id)
	{
		return self::_getOngoingWithTeam()
			->where('fixtureID', $id)
			->firstOrFail();
	}

	public static function getSingleOngoingStadium($id)
	{
		return self::_getOngoingWithTeam()
			->where('fixtureID', $id)
			->with('stadium')
			->firstOrFail();
	}

	protected static function calculateGoals($events, $homeTeamId, $awayTeamId)
	{
		$goals = [];
		foreach($events as $event)
		{
			// Goal id
			if ($event->eventID == 1)
			{
				if ( ! isset($goals[$event->teamID]))
					$goals[$event->teamID] = 1;
				else
					$goals[$event->teamID]++;
			}
		}

		return [
			'homeGoals' => isset($goals[$homeTeamId]) ? $goals[$homeTeamId] : 0,
			'awayGoals' => isset($goals[$awayTeamId]) ? $goals[$awayTeamId] : 0,
		];
	}

}