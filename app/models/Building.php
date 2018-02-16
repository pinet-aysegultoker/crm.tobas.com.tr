<?php


class Building extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'buildings';

    protected $fillable = ['project_id', 'creator_id', 'island', 'parcel', 'title', 'details', 'status'];

    public $timestamps = true;


}
