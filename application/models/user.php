<?php

class User extends Eloquent {

    public static $roles = array(
        'user'  => 0,
        'moderator' => 1,
        'admin' => 1,
    );
    public  static $stats_type = array(
        -1 => 'Заблокирован',
        0  => 'Подтверждение телефона',
        1  => 'Заполнение информации',
        2  => 'Активен',
    );
    public static $acc_type = array(
        0=>'Работодатель',
        1=>'Рабочий',
    );

    public static $gender = array(
        ''=>'Любой',
        '0'=>'Женский',
        '1'=>'Мужской'
    );

	public static $timestamps = true;
    private static $phone_pattern = '/^(\+7[-. ]?|8[-. ]?)?(\()?([0-9]{3})(?(2)\))[-. ]?(([0-9]{2})|([0-9]{3}))[-. ]?([0-9]{2})[-. ]?(?(6)([0-9]{2})|([0-9]{3}))$/';
    private static $phone_nums = 10;

	public function jobtypes()
	{
		return $this->has_many_and_belongs_to('Jobtype')->with('cost');
    }

    public function jobs()
    {
        return $this->has_many_and_belongs_to('Job');
    }

    public function posted_jobs()
    {
        return $this->has_many('Job');
    }

    /**
     * Хэширует устанавливаемый пароль
     * fLf: главное - не забыть об этом и не хэшировать его вручную
     * @param string $password Строка с паролем
     */
    public function set_password($password)
    {
        $this->set_attribute('password', Hash::make($password));
    }

    /**
     * Устанавливает телефон в стандартном виде
     * @param string $phone
     */
    public function set_phone($phone)
    {
        if(self::validate_phone($phone)) {
            $this->set_attribute('phone', self::trim_phone($phone));
        }
        // fLf: специально не отсекаю ситуацию, когда введен НЕ телефон
        // чтобы админам было комфортно
    }
    public function get_phone(){
        return '+7'.$this->get_attribute('phone');
    }

    /**
     * Валидация переданного телефона
     * @param  string $phone Телефон в любом доступном формате
     * @return bool        Подходит или нет
     */
    public static function validate_phone($phone)
    {
        return (bool) preg_match(self::$phone_pattern, $phone);
    }

    /**
     * Есть ли юзер с таким телефоном/логином или нет
     * @param  string $phone Телефон
     * @return bool        Есть или нет
     */
    public static function phone_exists($phone)
    {
        if(self::validate_phone($phone)) {
            $phone = self::trim_phone($phone);
        }
        $exists = self::where_phone($phone)->count();
        if($exists)
            return true;
        return false;
    }

    /**
     * Приводит телефон к виду, в котором он хранится в ДБ
     * @param  string $phone Кривой телефон
     * @return string        Прямой телефон
     */
    public static function trim_phone($phone)
    {
        return substr(preg_replace( '/[^0-9]+/', '', $phone), -self::$phone_nums );
    }
}
