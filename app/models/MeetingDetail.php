<?php


class MeetingDetail extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'meetings_details';

    protected $fillable = ['meeting_id', 'creator_id', 'details'];

    public $timestamps = true;

}
