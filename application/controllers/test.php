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

    public function action_usermodel($value='')
    {
        $u = User::query();
        $u->where('age', '>=', 18);
        $r = $u->get();
        var_dump($r);
        return '';
    }
}
