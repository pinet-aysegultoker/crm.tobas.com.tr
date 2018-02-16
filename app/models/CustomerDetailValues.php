<?php


class CustomerDetailValues extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers_details_values';

    protected $fillable = ['customer_id', 'type_id', 'value', 'creator_id', 'updater_id', 'status'];

    public $timestamps = true;

}
