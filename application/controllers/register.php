<?php

class Register_Controller extends Base_Controller {

    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
    }

	public function get_index()
	{
		// code here..
        if(Auth::guest()) {
            return View::make('register.index');
        }
        return View::make('register.loggedin');
	}

}
