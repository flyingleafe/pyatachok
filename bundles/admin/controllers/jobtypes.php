<?php
class Admin_Jobtypes_Controller extends Base_Controller {

    public $layout = 'admin::master';
    public $restful = true;

    public static $jobtype_add_rules = array(
        'name' => 'required|unique:jobtypes|max:64|min:6',
    );

    // fLf: ну вот опять хз зачем. ведь self::validate имеет почти такую же длину как и Validator::make =\

    public function get_index()
    {
        return View::make('admin::jobtypes.index');
    }

    public function get_add()
    {
        return View::make('admin::jobtypes.add');
    }
    
    public function post_add()
    {
        $validation = Validator::make(Input::All(), static::$jobtype_add_rules);

        if($validation->fails()){
            return View::make('admin::jobtypes.add')->with_errors($validation->errors);
        }

        Jobtype::create(array(
            'name'=>Input::get('name'),
        ));
        return Redirect::to('admin/jobtypes/index');

    }

}