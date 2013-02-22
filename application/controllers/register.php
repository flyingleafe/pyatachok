<?php

class Register_Controller extends Base_Controller {

    public $restful = true;

    public static $rules = array(
         'username'  => 'required|max:32',
         'name'  => 'required|max:50',
         'surname'  => 'required|max:50',
         'email' => 'required|email|unique:users',
         'password' => 'required|max:64|min:6|confirmed',
        );

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
    }


    public static function validate($data){
        return  Validator::make($data, static::$rules);
    }


	public function get_index()
	{

        $input = Input::all();

		// code here..
        if(Auth::guest()) {
            return View::make('register.index');
        }
        return View::make('register.loggedin');
	}

    public function post_create(){

        $validation = self::validate(Input::All());

        if($validation->fails()){
            return Redirect::to('register')->with_errors($validation)->with_input();

        }
        Users::create(array(
            'username'=>Input::get('username'),
            'email'=>Input::get('email'),
            'name'=>Input::get('name'),
            'surname'=>Input::get('surname'),
            'password'=>Input::get('password'),
        ));

        return Redirect::to('/');
                //->with('message' , 'Вы успешно зарегестрированы!');


    }
}
