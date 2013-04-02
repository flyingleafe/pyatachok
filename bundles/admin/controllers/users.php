<?php

class Admin_Users_Controller extends Base_Controller {

    public $layout = 'admin::master';
    public $restful = true;


    public  static $register_rules = array(
        'phone' => 'required|valid_phone|new_phone',
        'password' => 'required|max:64|min:6|confirmed',
    );

    public function __construct(){
        $this->filter('before', 'is_admin');
        $this->filter('before', 'auth')->on('post');
    }
    public function get_index()
    {
        return View::make('admin::users.index');
    }

    public function get_edit($id)
    {
        $user = User::find($id);
        if($user) {
            return View::make('admin::users.edit')->with('user', $user);
        }
        else {
            Redirect::to('admin/users')->with('user_missing', 'Пользователь с данным ID не найден');
        }
    }

    public function post_edit($id)
    {
        User::update($id, array(
            'status'=>  Input::get('status'),
            'name'=>  Input::get('name'),
            'phone'=> Input::get('phone'),
            'is_worker'=> Input::get('is_worker'),
            'about'=> Input::get('about'),
        ));
        return Redirect::to('admin/users/')->with('message', 'Пользователь изменен');
    }



    public function get_control(){
        return View::make('admin::users.control');
    }

    public function get_add(){
        return View::make('admin::users.add');
    }

    public function post_add(){

        /*$validation = Validator::make(Input::All(), static::$register_rules);

        if($validation->fails()) {
           return Redirect::to('register')->with('register_errors', $validation->errors)->with_input();
        }*/


        $user = new User;


        $user->fill(array(
            'phone'     =>  Input::get('phone'),
            'password'  => Input::get('password'),
            'role'  => Input::get('role'),
        ));

        var_dump($user);
        $user->save();

        return Redirect::to('admin/users/control')->with('message' , 'Пользователь успешно добавлен');

    }

}