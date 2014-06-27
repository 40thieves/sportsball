<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * Primary key of the table
	 * @var string
	 */
	protected $primaryKey = 'userID';

	/**
	 * Model attributes that can be mass-assigned
	 * @var array
	*/
	protected $fillable = [
		'username',
		'password'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/*
		* Implement methods from interface
		* TODO: Actually write some code
	*/
	public function getRememberToken() {
		return $this->rememberToken;
	}
	public function setRememberToken($token) {
		$this->rememberToken = $token;
	}
	public function getRememberTokenName() {
		return $this->rememberTokenName;
	}

	public static function createSingle() {

		$user = new Self;

		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));

		$user->save();
	}

}