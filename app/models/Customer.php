<?php


class Customer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers';

    protected $fillable = ['group_id', 'creator_id', 'updater_id', 'first_name', 'last_name', 'status', 'last_process_time'];

    public $timestamps = true;

}
