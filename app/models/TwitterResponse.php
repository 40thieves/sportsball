<?php

class TwitterResponse extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'twitterresponse';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'twitterresponseID';

	/**
	 * Turns off automatic timestamps
	 * @var boolean
	 */
	public $timestamps = true;

	/**
	 * Model attributes that can be mass-assigned
	 * @var array
	 */
	protected $fillable = [
		'content','fixtureID'
	];

	/**
	 * Model attributes that cannot be mass-assigned
	 * @var array
	 */
	protected $guarded = [
		'twitterresponseID',
	];

	public function tweets()
	{
		return $this->hasMany("Tweet","twitterresponseID");
	}

	public static function createSingle($content,$fixtureID)
	{
		$twitterresponse = new self;

		$twitterresponse->content = $content;
		$twitterresponse->fixtureID = $fixtureID;

		if ( ! $twitterresponse->save())
			App::abort('500', 'Save failed');

		return $twitterresponse;
	}

}