<?php

class Vote extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'votes';
	protected $guarded = array('id');
	
	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function votable()
    {
    	return $this->morphTo();
    }
	
}
