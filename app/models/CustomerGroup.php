<?php


class CustomerGroup extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers_groups';

    protected $fillable = ['parent_group_id', 'title', 'status'];

    public $timestamps = true;

}
