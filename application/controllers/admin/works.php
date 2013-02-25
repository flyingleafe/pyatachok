

<?php

class Admin_Works_Controller extends Base_Controller {
    public $layout = 'admin';

    public  static $work_add_rules = array(
        'name' => 'required|unique:jobtypes|max:64|min:6',

    );



    public static function validate($data, $rules){
        return  Validator::make($data, $rules);

    }

   public function action_index(){

       return View::make('admin.works.index');
   }



    public function action_add(){
        if(Request::method() == 'GET'){
             return View::make('admin.works.add');
        }
        else {
            $validation = self::validate(Input::All(), static::$work_add_rules);

            if($validation->fails()){
                return View::make('admin.works.add')->with_errors($validation->errors);
            }

             Jobtype::create(array(
                'name'=>Input::get('name'),
            ));
            return Redirect::to('admin/works/index');
        }

    }

}