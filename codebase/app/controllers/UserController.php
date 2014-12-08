<?php

class UserController  extends BaseController{
    public function showUserProfile($username){
        $user = User::where('username','=',$username)->first();
        
        if(empty($user)){
            return View::make('users.noprofile');
        }
        return View::make('users.profile')->with('user',$user);
    }
    public function handleUpdate($username){
        $validator = $this->getUpdateValidator();
        if ($validator->passes())
		{
            $user = User::where('username','=',$username)->first();
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            if(!empty(Input::get('password'))){
                $user->password = Hash::make(Input::get('password'));
            }
            $user->save();
            Session::flash('message', 'Your account has been updated successfully!');
			Session::flash('alert-class', 'alert-success');
            
            return Redirect::route("showUserProfile",$user->username);
		}else{
		    return Redirect::back()->withInput()->withErrors($validator);
		}
    }
    private function getUpdateValidator()
	{
		return Validator::make(Input::all(), [
			"password" => "confirmed|min:6",
			"first_name" => "required|alpha_dash",
			"last_name"	=> "required|alpha_dash"
		]);
	}
}