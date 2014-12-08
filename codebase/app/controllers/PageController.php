<?php

class PageController extends BaseController {

	public function showHome()
	{
		if(Auth::check()){
			return Redirect::route('challenges');
		}
		return View::make('home');
	}
	
	public function showAbout()
	{
		return View::make('about');
	}

}
