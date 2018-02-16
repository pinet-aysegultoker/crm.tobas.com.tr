<?php


class CustomerReminder extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers_reminders';

    protected $fillable = ['customer_id', 'creator_id', 'description', 'time'];

    public $timestamps = true;

}
