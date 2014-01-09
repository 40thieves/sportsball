<?php

class Stadium extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'stadium';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'stadiumID';

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
		'stadiumID',
	];
}