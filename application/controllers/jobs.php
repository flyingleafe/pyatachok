<?php

class Jobs_Controller extends Base_Controller {

    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'auth')->on('get');
        $this->filter('before', 'csrf')->on('post');
    }

	public function get_index()
	{
		// code here..

		return View::make('jobs.index');
	}

}
