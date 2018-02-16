<?php


class Apartment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'apartments';

    protected $fillable = ['building_id', 'creator_id', 'lot', 'bb_code', 'title', 'floor', 'number', 'net_area', 'gross_area', 'type', 'room', 'front', 'front_view', 'back_view', 'details', 'price', 'status'];

    public $timestamps = true;

}
