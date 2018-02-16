<?php


class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

    protected $fillable = ['creator_id', 'title', 'details', 'status'];

    public $timestamps = true;

}
