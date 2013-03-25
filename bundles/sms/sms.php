<?php

require_once(Bundle::path('sms').'scms.php');


class Sms{

    //Работадатель отказался от рабочего
    public static function employer_reject_worker($job_id, $worker_id){

        $message = "Ваше приглашение на работу отменено: ".self::jobUrl($job_id);
        echo $message;
        return;
    }


    //Рабочий  отказался от работ
    public static function worker_reject_job($job_id){
        $job = Job::find($job_id);
        $message = "Работник отказался принять участие в Вашей работе: ".self::jobUrl($job_id);
        echo $message;
        return;
        send_sms($job->phone, $message);
    }


    //Рабочий  отказался от работ
    public static function new_worker_joined($job_id){

        $message = "Новый отклик на Вашу работу: ".self::jobUrl($job_id);
        echo $message;
        return;

    }

    //Приглашение на закрытую работу после выбора всех рабочих
    public static function job_notifications($job_id){

        $workers = DB::table('jobs as j')
            ->where('j.id', '=', $job_id)
            ->join('job_user as ju', 'j.id', '=', 'ju.job_id')
            ->join('users as u', 'u.id', '=', 'ju.user_id')
            ->join('jobtypes as jt', 'jt.id', '=', 'j.id')
            ->get(array('u.id', 'u.phone', 'jt.name', 'j.phone'));

        $job = Job::find($job_id);

        $phones = array();
        foreach($workers as $worker){
            array_push($phones, $worker->phone);
        }

        $employer_name=$job->name;
        $phone=$job->phone;
        $jobtype = Jobtype::find($job->jobtype_id)->name;
        $place = $job->place;
        $time_start = $job->time_start;
        $time_end = $job->time_end;
        $price = $job->price;

        $message = 'Вас приглашает на работу'.' '. $employer_name.' (+7'.$phone.'), '.$jobtype.', '. $place.', c '.$time_start.' по '.$time_end. ' ('.$price.' руб/час)';
        echo $message;
        //send_sms($phones, self::$message);
    }

    private static function jobUrl($job_id){
        return URL::to('jobs').'/id/'.$job_id;
    }

}
?>