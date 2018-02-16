<?php


class Reserved extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reserved';

    protected $fillable = ['customer_id','apartment_id', 'creator_id', 'description', 'start_date', 'finish_Date', 'status'];

    public $timestamps = true;

}
