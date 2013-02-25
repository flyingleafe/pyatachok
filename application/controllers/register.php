<?php

class Register_Controller extends Base_Controller {

    public $restful = true;
    public static  $phone_regexp =  '/^(\+?[7-8]{1})?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{2})[-. ]?([0-9]{2})$/';

    /*Правила валидации*/
    private static $register_rules;
    private static $auth_rules;
    private static $profile_rules;
    private static $phone_rules;

    private static $numbers = 10;

    public function __construct() {
        $this->filter('before', 'csrf')->on('post');

        self::$register_rules = array(
            'phone' => 'required|unique:users|match:'.self::$phone_regexp,
            'password' => 'required|max:64|min:6|confirmed',
            'password_confirmation' => 'required',
            'is_worker'=>'required'
        );

        self::$auth_rules = array(
            'phone' => 'required|match:/^(\+?[7-8]{1})?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{2})[-. ]?([0-9]{2})$/',
            'password' => 'required',
        );
        self::$profile_rules = array(
            'name_and_surname'  => 'required|max:200',
        );
        self::$phone_rules = array(
            'code'  => 'required|code_valid',
        );

    }

     /**
     * Валидация данных
     * @param  Array $data Правила валидации
     * @return Validator       объект валидации
     */
    public static function validate($data, $rules){
        return  Validator::make($data, $rules);
        
    }


	public function get_index()	{

        $input = Input::all();

		// code here..
        if(Auth::guest()) {
            return View::make('register.index');
        }

        $status = (int) Auth::user()->status;

        //В зависимости от статуса пользователя покажем ему нужную страничку
        switch($status){
            case 0:
                return View::make('register.phone');
                break;
            case 1:
                 return View::make('register.profile');
                 break;
            case 2:
                 return Redirect::to('profile/index');
                 break;
            default:
                return View::make('register.profile');

        }
	}

     public function get_create(){
        return View::make('register.create');
     }

    /*Регистрация*/
    public function post_create(){

        $validation = self::validate(Input::All(), static::$register_rules);

        if($validation->fails()){
            return View::make('register.index', array('register_errors' => $validation->errors));
        }

        $user = User::create(array(
            'phone'=>$this->trim_phone(Input::get('phone')),
            'password'=> Hash::make(Input::get('password')),
            'is_worker'=> Input::get('is_worker'),
        ));

        Auth::login($user);

        return Redirect::to('register')->with('message' , 'Вы успешно зарегестрированы!');

    }


    public function post_profile(){
       $validation = self::validate(Input::All(), static::$profile_rules);

       if($validation->fails()){
            return Redirect::to('register')->with_errors($validation)->with_input();
       }
       
       else {
            Auth::user()->name_and_surname = Input::get('name_and_surname');
            Auth::user()->status = 2;
            Auth::user()->save();
            return Redirect::to('/');
       }
        
    }


    public function post_auth(){
        $phone = Input::get('phone');
        $password = Input::get('password');

        $validation = self::validate(Input::All(), static::$auth_rules);

        if($validation->fails()){

            return View::make('register.index', array('auth_errors' => $validation->errors));
        }

        $trimmed_phone =  $this->trim_phone($phone);

        $user = User::where('phone', '=', $trimmed_phone)->first();
        $hashed_value = $user->password;

        if (Hash::check($password, $hashed_value)){
            Auth::login($user);
            return Redirect::to('/');
        }
        else {
             $errors = new Laravel\Messages();
             $errors->add('auth', 'Неверное имя пользователя или пароль!');
             return Redirect::to('register/auth')->with_errors($errors);
        }
    }


    /*Проверка кода подтверждения*/
    public function post_phone(){
        $code = Input::get('code');
        if($code !=1235){
            $errors = new Laravel\Messages();
            $errors->add('valid_code', 'Неверный код подтверждения!');
            return Redirect::to('register/phone')->with_errors($errors);
        }
        else {
            Auth::user()->status = 1;
            Auth::user()->save();
            return Redirect::to('register');
        }
    }

    public function get_logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    /*Возвращает 10 цифр телефона*/
    private function trim_phone($phone){
        return substr(preg_replace( '/[^0-9]+/', '', $phone), -self::$numbers );
    }

}
