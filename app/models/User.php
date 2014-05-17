<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

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
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
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

	/**
	 * @brief Validates password match before actually
	 * saving the model.
	 */
	public function beforeSave() {
	}

	//public function getPasswordConfirmationAttribute( $password ) {
		//return $this->m_password_confirmation;
	//}

	//public function setPasswordConfirmationAttribute( $password ) {
		//$this->m_password_confirmation = $password;
	//}

	public static $rules = array(
		'username' => 'required|unique:users',
		'email' => 'required|unique:users|email',
		'password' => 'required',
		'password_confirmation' => 'same:password'
	);

	protected $fillable = array(
		'username',
		'email',
		'password',
		'password_confirmation',
		'first_name',
		'last_name'
	);

	public $autoPurgeRedundantAttributes = true;
	public static $passwordAttributes  = array('password');
	public $autoHashPasswordAttributes = true;

	//private $m_password_confirmation;
}
