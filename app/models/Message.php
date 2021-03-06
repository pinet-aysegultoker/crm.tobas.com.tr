<?php


class Message extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

    protected $fillable = ['name','email','ip','message','active'];

    public $timestamps = true;

}
