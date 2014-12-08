<?php

class AuthController extends BaseController {

	public function showLogin()
	{
		return View::make('login');
	}

	public function handleLogin()
	{
		$validator = $this->getLoginValidator();
		
		if ($validator->passes())
		{	
			// Choose to either use the email field or the username filed based on what the user entered
			$credential_field_name = filter_var(Input::get("email_or_username"), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
			
			$credentials = [
            	$credential_field_name => Input::get("email_or_username"),
            	"password" => Input::get("password")
        	];
			
			if (Auth::attempt($credentials)) {
				return Redirect::route('home');
			}
			
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	public function handleSignup()
	{
		$validator = $this->getSignupValidator();
		
		if ($validator->passes())
		{
			$user = new User;
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->email = Input::get('email');
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->save();
			
			//Set up the success message
			Session::flash('message', 'Your account has been created successfully!');
			Session::flash('alert-class', 'alert-success');
			
			return Redirect::route("showLogin");
			
		} else {	
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	public function handleLogout()
	{
		Auth::logout();
		
		return Redirect::route('home');
	}

	private function getLoginValidator()
	{
		return Validator::make(Input::all(), [
			"email_or_username" => "required",
			"password" => "required"
		]);
	}
	
	private function getSignupValidator()
	{
		return Validator::make(Input::all(), [
			"username" => "required",
			"password" => "required|confirmed|min:6",
			"email"	=> "required|email|unique:users",
			"first_name" => "required|alpha_dash",
			"last_name"	=> "required|alpha_dash"
		]);
	}

}
