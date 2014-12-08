<?php

class Challenge extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'challenges';
	protected $guarded = array('id');
	
	public function user()
	{
		return $this->belongsTo('User', 'created_by');
	}

    public function comments()
    {
        return $this->morphMany('Comment','commentable');
    }

    public function votes()
    {
        return $this->morphMany('Vote','votable');
    }

	public function solutions()
	{
		return $this->hasMany('Solution');
	}
	
}
