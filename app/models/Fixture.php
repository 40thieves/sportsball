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
		'stadiumID','hashTag','startTime','isOngoing',
	];

	/**
	 * Model attributes that cannot be mass-assigned
	 * @var array
	 */
	protected $guarded = [
		'fixtureID',
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

	protected static function _getFutureWithTeam()
	{
		return self::where('startTime','>=', date("Y-m-d H:i:s"))
			->with('homeTeam.teamDetails')
			->with('awayTeam.teamDetails');
	}

	public static function getAllFuture()
	{
		return self::_getFutureWithTeam()->get();
	}

	protected static function _getOngoingWithTeam()
	{			
		return self::whereBetween('startTime', [date("Y-m-d H:i:s",mktime(date('H')-3)),date("Y-m-d H:i:s")])
			->with('homeTeam.teamDetails')
			->with('awayTeam.teamDetails');
	}

	public static function getAllOngoing()
	{
		return self::_getOngoingWithTeam()->get();
	}

	protected static function _getPastWithTeam()
	{
		return self::where('startTime','<=', mktime(date('H')+3))
			->with('homeTeam.teamDetails')
			->with('awayTeam.teamDetails');
	}

	public static function getAllPast()
	{
		return self::_getPastWithTeam()->get();
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

	public static function testIsOngoing($id)
	{
		try {
			$fixture = self::where('fixtureID', $id)
				->where('isOngoing', '1')
				->firstOrFail();
		}
		catch (ModelNotFoundException $e) {
			App::abort('404', 'Fixture not found');
		}

		return $fixture;
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

	public static function createSingle()
	{
		$fixture = new self;

		$fixture->stadiumID = 1;
		$fixture->hashTag = Input::get('hashTag');
		$fixture->startTime = date('Y-m-d H:i:s',strtotime(Input::get('startTime')));
		
		$fixture->save();

		$teams = FixtureTeam::createBoth($fixture);
		$fixture->teams()->saveMany($teams);
	}

}
