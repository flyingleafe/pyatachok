<?php

class Admin_Home_Controller extends Base_Controller {

    public $restful = true;

    private static  $rules = array(
        'new_password' => 'required|max:64|min:6|confirmed',
    );
    public function get_index() {
        return View::Make('admin::home');
    }

    public function get_profile(){
        return View::Make('admin::profile');
    }


    public function post_profile(){
        $input = Input::All();
        $current_password = $input['current_password'];
        $new_password = $input['new_password'];

        $user = Auth::user();
        $validation = Validator::make($input, static::$rules);
        if (Hash::check($current_password, $user->password))  {
            if($validation->fails()) {
                return Redirect::to('admin/home/profile')->with('errors', $validation->errors)->with_input();
            }
            $user->set_password($new_password);
            $user->save();
            $message = new Laravel\Messages();
            $message->add('password', 'Пароль успешно изменён!');
            return Redirect::to('admin/home/profile')->with('message', $message);
        }
        else{
            $errors = new Laravel\Messages();
            $errors->add('password', 'Неверный текущий пароль!');
            return Redirect::to('admin/home/profile')->with('errors', $errors);
        }

    }

    public function get_stats(){
        return View::Make('admin::stats');
    }


}