<?php

class Admin_Users_Controller extends Base_Controller {

    public $layout = 'admin';

    public function action_index(){

        return View::make('admin.users.index');

    }

    public function action_edit($id){
        if(Request::method() == 'GET'){
            $user= User::find($id);

            if($user){
                return View::make('admin.users.edit')->with('user', $user);
            }
            else {
                Redirect::to('admin/users');

            }
        }

        else {
            $id = Input::get('id');
;
            User::update($id, array(
                'status'=>  Input::get('status'),
                'name'=>  Input::get('name'),
                'phone'=> Input::get('phone'),
                'is_worker'=> Input::get('is_worker'),
                'about'=> Input::get('about'),
                'updated_at' => DB::raw('NOW()'),
            ));
            return Redirect::to('admin/users/');
        }
    }

}