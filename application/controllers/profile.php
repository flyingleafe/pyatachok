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

    //@TODO комбинация user_id и job_type - составной ключ (уникальна)
    //Правила валидации
    public static $rules = array(

    );



    public function action_index(){

        $account_type = (int) Auth::user()->is_worker;
        switch($account_type){
            case 0:
                return View::make('profile.employer');
                break;
            case 1:
                $user = Auth::user();

             // $user_jobtypes =  $user->to_array();
                $user_jobtypes = $user->jobtypes()->get();
                $ids_array = array();
                foreach($user_jobtypes as $jobtype){
                    $ids_array[$jobtype->id] = $jobtype->id;
                }
                return View::make('profile.worker')->with( array('user_jobtypes'=>json_encode($ids_array)));
                break;
        }

    }

    //почему то не работает post_update()?
    //@TODO: валидация cost и user_id
    public function action_update(){
        if(Request::method()=='POST'){
            $input = Input::all();

            $job_ids = $input['job_ids'];
            $job_cost = $input['cost'];

            $user = Auth::user();


            foreach($job_ids as $k=>$id ){

                $user_jobtype =  $user->jobtypes()->attach($id, array('cost'=>$job_cost[$k]) );

            }
            return Redirect::to('profile');
        }
        else {

            return Redirect::to('profile/index');
        }
    }

}
