<?php

class Comment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';
	protected $guarded = array('id');
	
	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function commentable()
    {
    	return $this->morphTo();
    }
	
}
