<?php


class CallCenterLog extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'call_center_logs';

    protected $fillable = ['id', 'ip', 'result'];

    public $timestamps = true;

}
