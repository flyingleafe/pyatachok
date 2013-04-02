<?php
class Sms {

    //Работадатель отказался от рабочего
    public static function employer_reject_worker($job_id, $worker_id)
    {
        $job = Job::find($job_id);
        $message = "Ваше приглашение на работу отменено: ".Job::url($job_id);
        $phone = User::find($worker_id)->phone; //получаем тел. рабочего
        send_sms($phone, $message);
    }

    //Подтверждение номера телефона
    public static function phone_confirmation($user_id, $confirmation_code)
    {
        $phone = User::find($user_id)->phone;
        $message = 'Введите пожалуйста код подтверждения: '.$confirmation_code;
        send_sms($phone, $message);
    }

    //Рабочий  отказался от работ
    public static function worker_reject_job($job_id)
    {
        $job = Job::find($job_id);
        $message = "Работник отказался принять участие в Вашей работе: ".Job::url($job_id);
        send_sms($job->phone, $message);
    }


    //Рабочий  отказался от работ
    public static function new_worker_joined($job_id)
    {
        $job = Job::find($job_id);
        $message = "Новый отклик на Вашу работу: ".Job::url($job_id);
        send_sms($job->phone, $message);
    }

    //Приглашение на закрытую работу после выбора всех рабочих
    public static function job_notifications($job_id)
    {
        $job = Job::find($job_id);
        $workers = $job->workers()->get();

        $phones = array();
        foreach($workers as $worker){
            array_push($phones, $worker->phone);
        }
        $jobtype = $job->jobtype()->first()->name;
        // fLf: нет смысла перекодировать, такой же размер(
        $message = 'Вас приглашает на работу'.' '. $job->name.' ('.$job->phone.'), '.$jobtype.', '.$job->place.', c '.$job->time_start.' по '.$job->time_end.' ('.$job->price.' руб/час)';

        send_sms(join(',', $phones), $message);
    }
}
