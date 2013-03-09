<?php

class Profile_Controller extends Base_Controller {


    public $restful = true;

    //@TODO: добавить фильтры на проверку авторизации
    //@TODO: вывод только нужных скриптов в конкретный лейаут, а не всех
    // fLf: для этого, пожалуй, надо будет поставить бандл Basset - менеджер зависимостей ассетов.

    public function __construct()
    {
        $this->filter('before', 'auth');
        Asset::add('jquery', 'js/jquery-1.9.1.js');
        Asset::add('chosenjs', 'chosen/chosen.jquery.js');
        Asset::add('chosencss', 'chosen/chosen.css');
        Asset::add('chosenprotojs', 'chosen/chosen.proto.js');
        Asset::add('profile', 'js/profile.js');
    }

    //@TODO поиск по составному ключу, убрать поле id
    //Правила валидации
    public static $rules = array(
        'cost' => 'required|numeric|min:10|max:15000'
    );

    // fLf: я опять не понимаю, зачем эта обертка валидации здесь была

    public function get_index()
    {
        if(!Auth::user()->is_worker) {
            return View::make('profile.employer');
        }

        $ids_array = array();
        foreach(Auth::user()->jobtypes()->pivot()->get() as $jobtype) {
            $ids_array[$jobtype->jobtype_id] = $jobtype->cost;
        }
        return View::make('profile.worker')->with( array('user_jobtypes' => $ids_array) );
    }

    //Удалил и не проверил, опять всё упало
    public static function validate($data, $rules){
        return  Validator::make($data, $rules);
    }


    public function post_update()
    {
        $input = Input::all();

        if(isset($input['job_ids'])) {

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
                $row = DB::table('jobtype_user')
                    ->where('user_id', '=', $user->id)
                    ->where('jobtype_id', '=',$id);

                if( !$row->get() ) {
                     $user->jobtypes()->attach($id, array('cost'=>$job_cost[$k]) );
                } else {
                    $row->update( array('cost'=>$job_cost[$k])  );
                }


            }
            return Redirect::to('profile');
        }
    }

    public function post_delete_job()
    {
        if (Request::ajax())
        {
            $id =  $_GET['id'];
            Auth::user()->jobtypes()->detach($id);
        }
    }

    public function get_edit(){
        return View::Make('register.profile');
    }

}
