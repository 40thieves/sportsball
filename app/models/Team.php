<?php

class Team extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'team';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'teamID';

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
		'name',
	];

	/**
	 * Model attributes that cannot be mass-assigned
	 * @var array
	 */
	protected $guarded = [
		'teamID',
	];

	public function players()
	{
		return $this->hasMany('Player','teamID');
	}

	public static function getPlayers($id) 
	{
		return self::where('TeamID',$id)
			->with('players')
			->firstOrFail();
	}
}