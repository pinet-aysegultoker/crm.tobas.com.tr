<?php


class Offer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'offers';

    protected $fillable = ['apartment_id', 'customer_id', 'creator_id', 'subject', 'description', 'start_date', 'finish_date', 'price', 'discount'];

    public $timestamps = true;

}
