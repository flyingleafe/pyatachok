<?php
class Admin_Jobs_Controller extends Base_Controller {

    public $layout = 'admin::master';
    public $restful = true;

    public static $jobs = array(
        //'name' => 'required|unique:jobs|max:64|min:6',
    );


    public function get_index()
    {
        return View::make('admin::jobs.index');
    }

    public function get_add()
    {
        return View::make('admin::jobs.add');
    }


    public function get_view($id){

        $job = Job::find($id);
        return View::make('admin::jobs.view', array('model'=>$job) );

    }


    public function get_delete($id)
    {
        if (Request::ajax())
        {
            Job::find($id)->delete();
        }
    }

    public function post_add()
    {
        $validation = Validator::make(Input::All(), static::$jobtype_add_rules);

        if($validation->fails()){
            return View::make('admin::jobs.add')->with_errors($validation->errors);
        }

        Jobtype::create(array(
            'name'=>Input::get('name'),
        ));
        return Redirect::to('admin/jobs/index');

    }

}