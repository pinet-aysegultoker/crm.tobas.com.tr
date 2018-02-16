<?php


class Meeting extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'meetings';

    protected $fillable = ['customer_id', 'creator_id', 'updater_id', 'status'];

    public $timestamps = true;

}
