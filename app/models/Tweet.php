<?php

class Tweet extends Eloquent {

	/**
	 * The database table used by the model
	 * @var string
	 */
	protected $table = 'tweet';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'tweetID';

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
		'content','twitterresponseID'
	];

	/**
	 * Model attributes that cannot be mass-assigned
	 * @var array
	 */
	protected $guarded = [
		'tweetID',
	];

	public function twitterresponse()
	{
		return $this->belongsTo('TwitterResponse');
	}

	public static function createSingle($content,$twitterresponseID)
	{
		$tweet = new self;

		$tweet->content = $content;
		$tweet->twitterresponseID = $twitterresponseID;

		if ( ! $tweet->save())
			App::abort('500', 'Save failed');

		return $tweet;
	}

}