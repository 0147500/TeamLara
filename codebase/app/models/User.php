<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	public function createdChallenges()
	{
		return $this->hasMany('Challenge');
	}
	
	public function solutions()
	{
		return $this->hasMany('Solution');
	}
	
	public function getMySolutionToChallenge($challenge_id)
	{
		$solution = Solution::where('challenge_id', '=', $challenge_id)->where('user_id', '=', $this->id)->get();
		
		if(empty($solution) || empty($solution->first())){
			return FALSE;
		}
		
		return $solution->first();
	}
	
	public function profileLink()
	{
		return '<a href="' . URL::Route('showUserProfile', $this->username) . '">'. $this->username .'</a>';
	}

}
