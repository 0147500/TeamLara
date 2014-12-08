<?php

class SolutionController extends BaseController{
    
    public function handleCreateSolution(Challenge $challenge){
        
        if (Auth::user()->getMySolutionToChallenge($challenge->id)) {
        	// Solution already exists by the user, give an error message
        	
			Session::flash('message', 'You have already submitted a solution to this challenge. Please remove your solution if you want to resubmit.');
			Session::flash('alert-class', 'alert-warning');        	
        	return Redirect::back();
        }
        
        $validator = $this->getCreateSolutionValidator();
		
		if ($validator->passes())
		{
			$solution = new Solution;
			$solution->challenge_id = $challenge->id;
			$solution->user_id = Auth::user()->id;
			$solution->body = Input::get('body');
			$solution->reviewed_by = null;
			$solution->save();
			//print_r(Input::all());
			//Set up the success message
			Session::flash('message', 'Your solutions has been submmited successfully!');
			Session::flash('alert-class', 'alert-success');
			
			return Redirect::route("challenge",$challenge->id);
		} else {	
			return Redirect::back()->withInput()->withErrors($validator);
		}
    }
    private function getCreateSolutionValidator()
	{
		return Validator::make(Input::all(), [
			"body"	=> "required"
		]);
	}
	
	public function handleCreateComment(Solution $solution)
	{
		$validator = $this->getCreateCommentValidator();
		
		if ($validator->passes())
		{
			$comment = new Comment;
			$comment->user_id = Auth::user()->id;
			$comment->body = Input::get('body');
			$comment->save();
			
			$solution->comments()->save($comment);
			
			//Set up the success message
			Session::flash('message', 'Your comment has been saved successfully!');
			Session::flash('alert-class', 'alert-success');
			
			return Redirect::back();
			
		} else {	
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}
	
	public function handleDeleteSolution(Solution $solution){
		
        $solution = Solution::find($solution->id);
        
        if($solution && ($solution->user_id == Auth::user()->id)) {
        	$solution->delete();
        	Session::flash('message', 'Your solution to the challenge has been reset.');
        	Session::flash('alert-class', 'alert-success');
        }
		return Redirect::back();
		
	}
	
	public function handleMarksolution(Solution $solution){
		$solution = Solution::find($solution->id);
		$solution->reviewed_by = Auth::user()->id;
		$solution->reviewed_at = date("Y-m-d H:i:s");
		$solution->correct = true;
		if($solution->save()){
			
			// Solution saved as solved, reward the user with points
			$user = $solution->user;
			
			switch ($solution->challenge->difficulty) {
				case '1':
					$reward = 5;
					break;
				case '2':
					$reward = 10;
					break;
				case '3':
					$reward = 15;
					break;
			}
			
			$user->score = $user->score + $reward;
			$user->save();
			
			Session::flash('message', 'The solution has been marked as correct.');
        	Session::flash('alert-class', 'alert-success');
		}else{
			Session::flash('message', 'Your action has faild please try again.');
        	Session::flash('alert-class', 'alert-danger');
		}
		return Redirect::back();
	}
	
	private function getCreateCommentValidator()
	{
		return Validator::make(Input::all(), [
			"body"	=> "required"
		]);
	}

}