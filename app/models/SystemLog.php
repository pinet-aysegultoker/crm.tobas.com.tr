<?php


class SystemLog extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'system_logs';

    protected $fillable = ['user_id', 'user_ip', 'route', 'type', 'data_id'];

    public $timestamps = true;

}
