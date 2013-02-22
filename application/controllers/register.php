<?php

class Register_Controller extends Base_Controller {

    public $restful = true;

    public static $register_rules = array(
         'phone'  => 'required|max:10|min:10|unique:users',

         'email' => 'email|unique:users',
         'password' => 'required|max:64|min:6|confirmed',
        );


    public static $profile_rules = array(
         'name_and_surname'  => 'required|max:200',
         'email' => 'required|email|unique:users',
    );

    public static $phone_rules = array(
         'code'  => 'required|code_valid',
    );



    public function __construct()
    {

        $this->filter('before', 'csrf')->on('post');
    }


    public static function validate($data, $rules){
        return  Validator::make($data, $rules);
        
    }


	public function get_index()
	{

        $input = Input::all();

		// code here..
        if(Auth::guest()) {
            return View::make('register.index');
        }

        $status = (int) Auth::user()->status;
        //В зависимости от статуса пользователя покажем ему нужную страничку
        switch($status){
            case 0:
                return Redirect::to('register/phone');
                break;

            case 1:
                 return Redirect::to('register/profile');
                 break;
            case 2:
                 return Redirect::to('/');
                 break;
            default:
                 return Redirect::to('register/profile');

        }
        //return View::make('register.loggedin');
	}

    public function post_create(){
        

        $validation = self::validate(Input::All(), static::$register_rules);

        if($validation->fails()){
            return Redirect::to('register')->with_errors($validation)->with_input();

        }
        $user = User::create(array(
            'phone'=>Input::get('phone'),
            'password'=> Hash::make(Input::get('password')),
        ));

        Auth::login($user);

        return Redirect::to('register/profile');
                //->with('message' , 'Вы успешно зарегестрированы!');

    }

    public function get_phone(){
       return View::make('register.phone');
    }

    /*Проверка кода подтверждения*/
    public function post_phone(){
        
          $code = Input::get('code');
           if($code !=1235){
                $errors = new Laravel\Messages();
                $errors->add('valid_code', 'Неверный код подтверждения!');
                return Redirect::to('register/phone')->with_errors()->with_input();
           }

    }


    public function get_profile(){
      if (Auth::check()) {
        return View::make('register.profile');
      }
        else return Redirect::to('home/auth');
    }
    
    public function post_profile(){
       $validation = self::validate(Input::All(), static::$profile_rules);

    }


    public function get_auth(){
        return View::make('register.auth');
    }

    public function post_auth(){
        $phone = Input::get('phone');
        $password = Input::get('password');

        $user = DB::table('users')->where('phone', '=', $phone)->first();
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

}
