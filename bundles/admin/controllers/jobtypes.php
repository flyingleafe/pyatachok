<?php
class Admin_Jobtypes_Controller extends Base_Controller {

    public $layout = 'admin::master';
    public $restful = true;

    public static $jobtype_add_rules = array(
        'name' => 'required|unique:jobtypes|max:64|min:6',
    );

    public static $jobtype_edit_rules = array(
        'name' => 'required|max:64|min:6',
    );

    // fLf: ну вот опять хз зачем. ведь self::validate имеет почти такую же длину как и Validator::make =\

    public function get_index()
    {
        return View::make('admin::jobtypes.index');
    }

    public function get_add()
    {
        $model = new Jobtype();
        return View::make('admin::jobtypes.add', array('model'=>$model));
    }
    
    public function post_add()
    {
        $validation = Validator::make(Input::All(), static::$jobtype_add_rules);

        if($validation->fails()){
            return View::make('admin::jobtypes.add', array('model'=> new Jobtype()))->with_errors($validation->errors);
        }

        Jobtype::create(array(
            'name'=>Input::get('name'),
        ));
        return Redirect::to('admin/jobtypes/index');

    }

    public function get_edit($id){
        $model = Jobtype::find($id);
        return View::make('admin::jobtypes.edit', array( 'model'=>$model));
    }

     public function post_edit(){
         $validation = Validator::make(Input::All(), static::$jobtype_edit_rules);

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