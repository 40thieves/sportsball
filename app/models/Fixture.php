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

	public function facts()
	{
		return $this->hasMany('FixtureFact','fixtureID');
	}

	public function teams()
	{
		return $this->hasMany('FixtureTeam', 'fixtureID');
	}

	public function twitterResponses()
	{
		return $this->hasMany('TwitterResponse','fixtureID');
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
		return self::where('startTime','<=', date("Y-m-d H:i:s",mktime(date('H')+3)))
			->with('homeTeam.teamDetails')
			->with('awayTeam.teamDetails')
			->orderBy('startTime','desc');
	}

	public static function getAllPast()
	{
		return self::_getPastWithTeam()->get();
	}

	public static function getSingle($id)
	{
		$fixture = self::_getSingleWithTeams()
			->where('fixtureID', $id)
			->with('events.eventType', 'events.player')
			->with('stadium')
			->with('twitterresponses')
			->firstOrFail();

		$goals = self::calculateGoals($fixture->events, $fixture->homeTeam->teamID, $fixture->awayTeam->teamID);
		$fixture->homeTeam->goals = $goals['homeGoals'];
		$fixture->awayTeam->goals = $goals['awayGoals'];

		return $fixture;
	}

	protected static function _getSingleWithTeams()
	{
		return self::with('homeTeam.teamDetails')->with('awayTeam.teamDetails');
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
