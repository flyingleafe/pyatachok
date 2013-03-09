<?php

class Profile_Controller extends Base_Controller {

    // fLf: не забывай эти штуки, Андрюх
    public $restful = true;

    //@TODO: добавить фильтры на проверку авторизации
    //@TODO: вывод только нужных скриптов в конкретный лейаут, а не всех
    // fLf: для этого, пожалуй, надо будет поставить бандл Basset - менеджер зависимостей ассетов.

    public function __construct()
    {
        Asset::add('chosenjs', 'chosen/chosen.jquery.js', 'jquery');
        Asset::add('chosencss', 'chosen/chosen.css');
        Asset::add('chosenprotojs', 'chosen/chosen.proto.js', 'jquery');
        Asset::add('profile', 'js/profile.js', 'jquery');
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

    public function post_update()
    {
        $job_ids  = Input::get('job_ids');
        $job_cost = Input::get('cost');

        if( !empty($job_ids) ) {
            $user = Auth::user();
            foreach($job_ids as $k => $id){

                $validation = Validator::make(array('cost'=>$job_cost[$k]), static::$rules);

                if($validation->fails()){
                    //@TODO: вывод ошибок над кокретной строчкой (как передать в парам. $k? вместе с ошибками)
                    return Redirect::to('profile')->with_errors($validation);
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
        }
        return Redirect::to('profile');
    }

    public function post_delete_job()
    {
        if (Request::ajax())
        {
            $id = $_GET['id'];
            Auth::user()->jobtypes()->detach($id);
        }
    }

}
