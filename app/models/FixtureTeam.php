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

	public function teamName()
	{
		return $this->hasOne('Team', 'teamID');
	}
}