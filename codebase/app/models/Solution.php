<?php

class Solution extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'solutions';
	protected $guarded = array('id');
	
	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function challenge()
	{
		return $this->belongsTo('Challenge');
	}
	
	public function reviewedBy()
	{
		return $this->belongsTo('User','reviewed_by');
	}
	
    public function comments()
    {
        return $this->morphMany('Comment','commentable');
    }
    
    public function votes()
    {
        return $this->morphMany('Vote','votable');
    }
}
