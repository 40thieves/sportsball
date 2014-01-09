<?php

class Player extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'player';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'playerID';

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
		'squadNo',
		'teamID',
		'name',
	];

	/**
	 * Model attributes that cannot be mass-assigned
	 * @var array
	 */
	protected $guarded = [
		'playerID',
	];

	public function teamName()
	{
		return $this->hasOne('Team', 'teamID');
	}
}