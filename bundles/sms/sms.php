<?php
// SMSC.RU API (smsc.ru) версия 2.7 (07.06.2012)

define("SMSC_LOGIN", "5ok");		// логин клиента
define("SMSC_PASSWORD", "eb83d6775d974c1c5daf887abbfdb858");	// пароль или MD5-хеш пароля в нижнем регистре
define("SMSC_POST", 0);					// использовать метод POST
define("SMSC_HTTPS", 0);				// использовать HTTPS протокол
define("SMSC_CHARSET", "utf-8");	// кодировка сообщения: utf-8, koi8-r или windows-1251 (по умолчанию)
define("SMSC_DEBUG", 0);				// флаг отладки
define("SMTP_FROM", "notify@5ok.su");     // e-mail адрес отправителя

// Функция отправки SMS
//
// обязательные параметры:
//
// $phones - список телефонов через запятую или точку с запятой
// $message - отправляемое сообщение
//
// необязательные параметры:
//
// $translit - переводить или нет в транслит (1,2 или 0)
// $time - необходимое время доставки в виде строки (DDMMYYhhmm, h1-h2, 0ts, +m)
// $id - идентификатор сообщения. Представляет собой 32-битное число в диапазоне от 1 до 2147483647.
// $format - формат сообщения (0 - обычное sms, 1 - flash-sms, 2 - wap-push, 3 - hlr, 4 - bin, 5 - bin-hex, 6 - ping-sms)
// $sender - имя отправителя (Sender ID). Для отключения Sender ID по умолчанию необходимо в качестве имени
// передать пустую строку или точку.
// $query - строка дополнительных параметров, добавляемая в URL-запрос ("valid=01:00&maxsms=3&tz=2")
//
// возвращает массив (<id>, <количество sms>, <стоимость>, <баланс>) в случае успешной отправки
// либо массив (<id>, -<код ошибки>) в случае ошибки


class Sms {

    //Работадатель отказался от рабочего
    public static function employer_reject_worker($job_id, $worker_id){
        $job = Job::find($job_id);
        $message = "Ваше приглашение на работу отменено: ".self::jobUrl($job_id);
        $phone = User::find($worker_id)->phone; //получаем тел. рабочего
        send_sms($phone, $message);
    }

    //Подтверждение номера телефона
    public static function phone_confirmation($user_id, $confirmation_code){
        $phone = User::find($user_id)->phone;
        $message = 'Введите пожалуйста код подтверждения: '.$confirmation_code;
        send_sms($phone, $message);
    }

    //Рабочий  отказался от работ
    public static function worker_reject_job($job_id){
        $job = Job::find($job_id);
        $message = "Работник отказался принять участие в Вашей работе: ".self::jobUrl($job_id);
        send_sms($job->phone, $message);
    }


    //Рабочий  отказался от работ
    public static function new_worker_joined($job_id){
        $job = Job::find($job_id);
        $message = "Новый отклик на Вашу работу: ".self::jobUrl($job_id);
        send_sms($job->phone, $message);
    }

    //Приглашение на закрытую работу после выбора всех рабочих
    public static function job_notifications($job_id){

        $workers = DB::table('jobs as j') //получаем всех рабочих по id работы и их данные
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
        send_sms($phones, self::$message);
    }

    private static function jobUrl($job_id){
        return URL::to('jobs').'/id/'.$job_id;
    }

}
?>
