<?php

class ChallengeController extends BaseController{
    
    public function showChallenges()
    {
        $challenges = Challenge::paginate(5);   
        
        return View::make('challenges.challenges')->with('challenges',$challenges);
    }
    
    public function showChallenge(Challenge $challenge)
    {
        $challenge = Challenge::find($challenge->id);
        $comment = $challenge->comments->all();
        $solutions = $challenge->solutions();
        $userSolution = Auth::user()->getMySolutionToChallenge($challenge->id);
        
        return View::make('challenges.challenge')->with('challenge', $challenge)->with('comments',$comment)->with('solutions',$solutions)->with('userSolution', $userSolution);
    }
    public function showCreateChallenge(){
        Return View::make('challenges.newChallenge');
    }

	public function handleCreateChallenge()
	{
		$validator = $this->getCreateChallengeValidator();
		
		if ($validator->passes())
		{
			$user = new Challenge;
			$user->name = Input::get('name');
			$user->description = Input::get('description');
			$user->body = Input::get('body');
			$user->difficulty = Input::get('difficulty');
			$user->created_by = Auth::id();
			$user->save();
			
			//Set up the success message
			Session::flash('message', 'Your challenge has been created successfully!');
			Session::flash('alert-class', 'alert-success');
			
			return Redirect::route("challenges");
			
		} else {	
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}
	
	public function showMyChallenges(){
		$challenges = Challenge::where('created_by','=',Auth::user()->id)->get();
		return View::make('challenges.myChallenges')->with('challenges',$challenges);
	}
	
	private function getCreateChallengeValidator()
	{
		return Validator::make(Input::all(), [
			"name" => "required",
			"description" => "required",
			"body"	=> "required",
			"difficulty" => "required|numeric"
		]);
	}
	
	public function handleCreateComment(Challenge $challenge)
	{
		$validator = $this->getCreateCommentValidator();
		
		if ($validator->passes())
		{
			$comment = new Comment;
			$comment->user_id = Auth::user()->id;
			$comment->body = Input::get('body');
			$comment->save();
			
			$challenge->comments()->save($comment);
			
			//Set up the success message
			Session::flash('message', 'Your comment has been saved successfully!');
			Session::flash('alert-class', 'alert-success');
			
			return Redirect::to(URL::previous() . '#Discussion');
			
		} else {	
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}
	
	private function getCreateCommentValidator()
	{
		return Validator::make(Input::all(), [
			"body"	=> "required"
		]);
	}
    
}