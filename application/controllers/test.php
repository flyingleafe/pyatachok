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

    public function action_clean($param='chosen_workers')
    {
        Session::forget($param);
        return "cleaned! ;3";
    }

    public function action_msg()
    {
        $job = Job::find(417);
        $jobtype = $job->jobtype()->first()->name;
        $message = mb_convert_encoding(
            'Вас приглашает на работу'.' '. $job->name.' ('.$job->phone.'), '.$jobtype.', '. $job->place.', c '.$job->time_start.' по '.$job->time_end. ' ('.$job->price.' руб/час)',
            SMSC_CHARSET,
            "utf-8"
        );
        return $message;
    }
}
