<?php

class Admin_Auth_Controller extends Base_Controller {

    public $restful = true;


    public function __construct()
    {
        Asset::add('jquery', 'js/jquery-1.9.1.js');
        Asset::add('chosenjs', 'chosen/chosen.jquery.js');
        Asset::add('chosencss', 'chosen/chosen.css');
        Asset::add('chosenprotojs', 'chosen/chosen.proto.js');
        Asset::add('profile', 'js/profile.js');
    }

    public function get_index(){

        return View::Make('admin::auth');
    }

    public function post_index()   {

        $phone    = Input::get('phone');
        $password = Input::get('password');


        $data = array(
            'username' => $phone,
            'password' => $password
        );

        if ( Auth::attempt($data) ){
            $user = DB::table('users')->where('phone', '=', $phone)->first();

            if($user->role > 0){
                return Redirect::to('admin');
            }
            else{
                return Redirect::to('/');
            }
        }

        else {
            $errors = new Laravel\Messages();
            $errors->add('auth', 'Неверное имя пользователя или пароль!');
            return Redirect::to('admin/auth')->with('auth_errors', $errors);
        }
    }
}