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

	public function events()
	{
		return $this->hasMany('FixtureEvent', 'fixtureID');
	}

	public function teams()
	{
		return $this->hasMany('FixtureTeam', 'fixtureID');
	}

	public function stadium()
	{
		return $this->hasOne('Stadium', 'stadiumID');
	}

	public static function getAllOngoing()
	{
		return self::where('isOngoing', '1')->get();
	}

}