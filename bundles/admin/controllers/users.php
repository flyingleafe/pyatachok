<?php

class Admin_Users_Controller extends Base_Controller {

    public $layout = 'admin::master';
    public $restful = true;

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

}