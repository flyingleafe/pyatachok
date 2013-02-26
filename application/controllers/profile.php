<?php

class Profile_Controller extends Base_Controller {

    //@TODO: добавить фильтры на проверку авторизации
    //@TODO: вывод только нужных скриптов в конкретный лейаут, а не всех

    public function __construct(){
        Asset::add('jquery', 'js/jquery-1.9.1.js');
        Asset::add('chosenjs', 'chosen/chosen.jquery.js');
        Asset::add('chosencss', 'chosen/chosen.css');
        Asset::add('chosenprotojs', 'chosen/chosen.proto.js');

    }

    //@TODO поиск по составному ключу, убрать поле id
    //Правила валидации
    public static $rules = array(
        'cost' => 'required|min:1|max:8'
    );


    public static function validate($data, $rules){
        return  Validator::make($data, $rules);

    }
    public function action_index(){

        $account_type = (int) Auth::user()->is_worker;
        switch($account_type){
            case 0:
                return View::make('profile.employer');
                break;
            case 1:
                $user = Auth::user();

                $user_jobtypes = $user->jobtypes()->pivot()->get();
                $ids_array = array();
                if($user_jobtypes){
                    foreach($user_jobtypes as $jobtype){
                        Jobtype::find($jobtype->jobtype_id)->name;
                        $ids_array[$jobtype->jobtype_id] = $jobtype->cost;
                    }
                }
                return View::make('profile.worker')->with( array('user_jobtypes'=>$ids_array));
                break;
        }

    }

    //почему то не работает post_update()?
    //@TODO: user_id
    public function action_update(){
        if(Request::method()=='POST'){
            $input = Input::all();

            $job_ids = $input['job_ids'];
            $job_cost = $input['cost'];

            $user = Auth::user();


            foreach($job_ids as $k=>$id ){

                $validation = self::validate(array('cost'=>$job_cost[$k]), static::$rules);

                if($validation->fails()){
                    //@TODO: вывод ошибок над кокретной строчкой (как передать в парам. $k? вместе с ошибками)
                    return Redirect::to_action('profile/index')->with_errors($validation);
                }

                //Записи с составным ключом user.id+jobtype_id не существует
                $row = DB::table('user_jobtype')
                    ->where('user_id', '=', $user->id)
                    ->where('jobtype_id', '=',$id);

                if(!$row->get())
                {
                     $user->jobtypes()->attach($id, array('cost'=>$job_cost[$k]) );
                }
                else
                {
                    $row->update( array('cost'=>$job_cost[$k])  );
                }


            }
            return Redirect::to('profile');
        }
        else {

            return Redirect::to('profile/index');
        }
    }

    public function action_delete_job()
    {
        if (Request::ajax())
        {
            $id =  $_GET['id'];
            $user = Auth::user();

            DB::table('user_jobtype')
                ->where('user_id', '=', $user->id)
                ->where('jobtype_id', '=', $id)->delete();


        }
    }

}
