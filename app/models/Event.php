<?php

class Event extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'event';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'eventID';

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
		'label',
	];

	/**
	 * Model attributes that cannot be mass-assigned
	 * @var array
	 */
	protected $guarded = [
		'eventID',
	];
}