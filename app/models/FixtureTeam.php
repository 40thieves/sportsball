<?php

class FixtureTeam extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'fixtureTeam';

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
		'teamID',
		'homeTeam',
	];

	public function teamDetails()
	{
		return $this->hasOne('Team', 'teamID', 'teamID');
	}

	public static function createBoth($fixture) {
		
		$homeTeam = new self;
		$homeTeam->fixtureID = $fixture->fixtureID;
		$homeTeam->teamID = Input::get('homeTeam');
		$homeTeam->homeTeam = 1;

		$homeTeam->save();

		$awayTeam = new self;
		$awayTeam->fixtureID = $fixture->fixtureID;
		$awayTeam->teamID = Input::get('awayTeam');
		$awayTeam->homeTeam = 0;

		$awayTeam->save();

		return [$homeTeam,$awayTeam];

	}
}