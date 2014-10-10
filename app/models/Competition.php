<?php

class Competition extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'competition';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'competitionID';

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
		'competitionID',
	];

	public function teams()
	{
		return $this->belongsToMany('Team');
	}

	public function fixtures()
	{
		return $this->hasMany('Fixture','competitionID');
	}

	// public static function create($name)
	// {
	// 	$competition = new self();
	// 	$competition->name = $name;
	// 	$competition->save();
	// }

}