<?php


class CustomerDetailType extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers_details_types';

    protected $fillable = ['title','type','title_id','type_array','status','mask'];

    public $timestamps = true;

}
