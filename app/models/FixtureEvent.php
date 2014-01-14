<?php

class FixtureEvent extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'fixtureEvent';

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
		'fixtureID',
		'eventID',
		'teamID',
		'playerID',
		'minute',
	];

	public function eventType()
	{
		return $this->hasOne('EventType', 'eventID', 'eventID');
	}

	public function goals()
	{
		return $this->hasOne('EventType', 'eventID', 'eventID')->where('eventID', '1');
	}

	public function player()
	{
		return $this->hasOne('Player', 'playerID');
	}

	public function fixture()
	{
		return $this->belongsTo('Fixture', 'fixtureID');
	}

	public static function getAllOngoing()
	{
		$events = self::all();

		$events = $events->filter(function($event) {
			return ($event->fixture->isOngoing == '1');
		});

		return $events->load('eventType');
	}

	public static function getSingleOngoing($id)
	{
		$event = self::find($id);

		if ($event->fixture->isOngoing != '1')
			return App::abort('404', 'Fixture not found');

		return $event->load('eventType');
	}

	public static function createSingle()
	{
		$event = new self;

		$fixture = Fixture::testIsOngoing(Input::get('fixtureID'));

		$event->fixtureID = $fixture->fixtureID;
		$event->eventID = Input::get('eventID');
		$event->teamID = Input::get('teamID');
		$event->playerID = Input::get('playerID');
		$event->minute = Input::get('minute');

		if ( ! $event->save())
			App::abort('500', 'Save failed');

		Pusherer::trigger('fixture_' . $fixture->fixtureID, 'event_' . $event->eventID, array(
			'fixtureID' => $fixture->fixtureID,
			'eventID' => $event->eventID,
			'teamID' => $event->teamID,
			'playerID' => $event->playerID,
			'minute' => $event->minute,
		));

		return $event;
	}

}