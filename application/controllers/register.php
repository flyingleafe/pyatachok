<?php

class Register_Controller extends Base_Controller {

    public $restful = true;

    /*Правила валидации*/
    private static $register_rules;
    private static $auth_rules;
    private static $profile_rules;
    private static $phone_rules;

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');

        self::$register_rules = array(
            'phone' => 'required|valid_phone|new_phone',
            'password' => 'required|max:64|min:6|confirmed',
            'is_worker'=>'required'
        );

        self::$auth_rules = array(
            'phone' => 'required|valid_phone',
            'password' => 'required',
        );
        self::$profile_rules = array(
            'name'  => 'required|max:200',
            'gender'  => 'required',
        );
        self::$phone_rules = array(
            'code'  => 'required|code_valid',
        );
    }

	public function get_index()
    {
        if(Auth::guest()) {
            return View::make('register.index');
        }

        //В зависимости от статуса пользователя покажем ему нужную страничку
        switch(Auth::user()->status) {
            case 0:
                return View::make('register.phone');
            case 1:
                return View::make('register.profile');
            case 2:
                return Redirect::to('profile');
            default:
                return View::make('register.profile');
        }
	}

    /*Регистрация*/
    public function post_create()
    {
        $validation = Validator::make(Input::All(), static::$register_rules);

        if($validation->fails()) {
            return Redirect::to('register')->with('register_errors', $validation->errors)->with_input();
        }

        $user = User::create(array(
            'phone'     => Input::get('phone'),
            'password'  => Input::get('password'),
            'is_worker' => Input::get('is_worker'),
        ));

        Auth::login($user);
        return Redirect::to('register')->with('message' , 'Вы успешно зарегистрированы!');
    }

    public function post_profile()
    {
        $validation = Validator::make(Input::all(), static::$profile_rules);

        if($validation->fails()){
            return Redirect::to('register')->with_errors($validation)->with_input();
        }
       
        else {
            Auth::user()->name = Input::get('name');
            Auth::user()->status = 2;
            Auth::user()->gender = Input::get('gender');
            Auth::user()->save();
            return Redirect::to('/');
        }
        
    }

    public function post_auth()
    {

       $phone    = Input::get('phone');
        $password = Input::get('password');


        $validation = Validator::make(Input::all(), self::$auth_rules);

        if($validation->fails()){
            return Redirect::to('register')->with('auth_errors', $validation->errors);
        }

        $data = array(
            'username' => User::trim_phone($phone),
            'password' => $password
        );


        // fLf: аутентификация ту делается в 1 строку:
        if ( Auth::attempt($data) ){
            return Redirect::to('/');
        }

        else {
            $errors = new Laravel\Messages();
            $errors->add('auth', 'Неверное имя пользователя или пароль!');
            return Redirect::to('register')->with('auth_errors', $errors);
        }
    }

    /*Проверка кода подтверждения*/
    public function post_phone()
    {
        $code = Input::get('code');
        if($code != 1235){
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

    // fLf: перенес logout в роуты, че ему тут делать - никак ни от чего не зависит, и register/logout смотрится нелогично
}
