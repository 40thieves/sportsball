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

}