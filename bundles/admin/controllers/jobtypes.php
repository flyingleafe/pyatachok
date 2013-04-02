<?php
class Admin_Jobtypes_Controller extends Base_Controller {

    public $layout = 'admin::master';
    public $restful = true;

    public function __construct(){
        $this->filter('before', 'is_admin');
    }

    public function get_index()
    {
        return View::make('admin::jobtypes.index');
    }

    public function get_add()
    {
        $model = new Jobtype();
        return View::make('admin::jobtypes.add', array('model'=>$model));
    }
    
    public function post_add() {

        $input = Input::All();
        $input['name'] = Jobtype::strtolower_utf8(Input::get('name'));

        $validation = Validator::make($input, Jobtype::$jobtype_add_rules);

        if($validation->fails()){
            return View::make('admin::jobtypes.add', array('model'=> new Jobtype()))->with_errors($validation->errors);
        }

        $jobtype = new Jobtype();
        $jobtype->set_name($input['name']);
        $jobtype->save();

        return Redirect::to('admin/jobtypes/index');
    }

    public function get_edit($id){
        $model = Jobtype::find($id);
        return View::make('admin::jobtypes.edit', array( 'model'=>$model));
    }

     public function post_edit(){
         $validation = Validator::make(Input::All(), Jobtype::$jobtype_edit_rules);

         if($validation->fails()){
             return View::make('admin::jobtypes.edit', array('model'=> new Jobtype()))->with_errors($validation->errors);
         }
         return Redirect::to('admin/jobtypes/index');
     }


    public function post_search(){
        $input = Input::all();
        $name = $input['jobtype_name'];
        $jobtypes = DB::table('jobtypes')->where('name',  'LIKE', '%'.$name.'%')->get();
        return View::make('admin::jobtypes.search', array('jobtypes'=>$jobtypes));
    }

}