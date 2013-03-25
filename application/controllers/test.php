<?php

class Test_Controller extends Base_Controller {

	public function action_index()
	{

       Sms::job_notifications(1);
		//return View::make('test.index');
	}

    public function action_env($value='')
    {
        return Request::env();
    }

    public function action_usermodel($param='0')
    {
        $u = User::query();
        $u->where('team', '=', $param);
        $r = $u->paginate(30);
        return render('workers.search', array( 'workers' => $r));
    }
}
