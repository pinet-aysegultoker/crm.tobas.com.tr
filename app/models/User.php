<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

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

    protected $fillable = ['group_id', 'creator_id', 'updater_id', 'username', 'email', 'first_name', 'last_name', 'password', 'status', 'last_login_ip', 'last_login_time'];

	protected $hidden = array('remember_token');

    public $timestamps = true;


}
