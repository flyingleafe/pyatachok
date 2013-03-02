<?php

class Test_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('test.index');
	}

    public function action_env($value='')
    {
        return Request::env();
    }
}
