<?php


class PaymentPlan extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'payment_plans';

    protected $fillable = ['apartment_id', 'customer_id', 'creator_id', 'price', 'discount', 'advance'];

    public $timestamps = true;

}
