<?php

class VoteController extends BaseController {
	public function voteUpChallenge(Challenge $challenge)
	{	
		// If user has already voted up that challenge, redirect with appropriate message
		if ($challenge->votes()->where('user_id', '=', Auth::user()->id)->where('value', '=', 1)->get()->count() > 0) {
			
			// set messages
			Session::flash('message', 'You have already voted up this challenge!');
			Session::flash('alert-class', 'alert-warning');			
			
			return Redirect::back();
		}

		// If user has voted the challenge down before, add 2 points, else add 1 point
		if ($challenge->votes()->where('user_id', '=', Auth::user()->id)->where('value', '=', -1)->get()->count() > 0) {
			$addPoints = 2;
		} else {
			$addPoints = 1;
		}

		$vote = Vote::firstOrCreate(array('user_id' => Auth::User()->id, 'votable_id' => $challenge->id, 'votable_type' => 'Challenge'));
		$vote->user_id = Auth::user()->id;
		$vote->value = 1;
		$vote->save();
		
		$challenge->rating = $challenge->rating + $addPoints;
		$challenge->save();

		// set messages
		Session::flash('message', 'Up vote accepted!');
		Session::flash('alert-class', 'alert-success');		

		return Redirect::back();
	}
	
	public function voteDownChallenge(Challenge $challenge)
	{	
		// If user has already voted down that challenge, redirect with appropriate message
		if ($challenge->votes()->where('user_id', '=', Auth::user()->id)->where('value', '=', -1)->get()->count() > 0) {
			
			// set messages
			Session::flash('message', 'You have already voted down this challenge!');
			Session::flash('alert-class', 'alert-warning');			
			
			return Redirect::back();
		}
		
		// If user has voted the challenge up before, remove 2 points, else remove 1 point
		if ($challenge->votes()->where('user_id', '=', Auth::user()->id)->where('value', '=', 1)->get()->count() > 0) {
			$removePoints = 2;
		} else {
			$removePoints = 1;
		}
		
		$vote = Vote::firstOrCreate(array('user_id' => Auth::User()->id, 'votable_id' => $challenge->id, 'votable_type' => 'Challenge'));
		$vote->user_id = Auth::user()->id;
		$vote->value = -1;
		$vote->save();
		
		$challenge->rating = $challenge->rating - $removePoints;
		$challenge->save();

		// set messages
		Session::flash('message', 'Down vote accepted!');
		Session::flash('alert-class', 'alert-success');		

		return Redirect::back();
	}
}