<?php


class Sales extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sales';

    protected $fillable = ['apartment_id','creator_id', 'customer_id', 'offer_id', 'subject', 'description', 'start_date', 'finish_date', 'price', 'discount'];

    public $timestamps = true;

}
