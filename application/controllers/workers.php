<?php

class Workers_Controller extends Base_Controller {

    public $restful = true;

    private static $per_page = 10;

    private static $hire_validation = array(
        'name'       => 'required',
        'phone'      => 'required|valid_phone',
        'place'      => 'required',
        'time_start' => 'required',
        'time_end'   => 'required',
    );

    public function __construct(){
        Asset::add('jquery', 'js/jquery-1.9.1.js')
            ->add('jquery_ui', 'js/jquery-ui-1.10.1.custom.js')
            ->add('jquery-ui-sliderAccess', 'js/jquery-ui-sliderAccess.js')
            ->add('jquery-ui-timepicker', 'js/jquery-ui-timepicker-addon.js')
            ->add('jquery-ui-timepicker-ru', 'js/jquery-ui-timepicker-ru.js')
            ->add('jquery_ui_css', 'css/ui-lightness/jquery-ui-1.10.1.custom.css')
            ->add('chosen', 'chosen/chosen.jquery.js', 'jquery')
            ->add('chosen_css', 'chosen/chosen.css')
            ->add('handlebars', 'js/handlebars.js')
            ->add('pagination', 'js/jquery.simplePagination.js')
            ->add('pagination_css', 'css/simplePagination.css')
            ->add('search', 'js/search.js', 'chosen')
            ->add('workers-search', 'js/workers-search.js', 'search');
    }

	public function get_index()
    {
        Seovel::setTitle('Поиск рабочих');
		return View::make('workers.index');
	}

    public function get_search()
    {
		return Redirect::to('workers');
	}

    public function get_hire()
    {
        Seovel::setTitle('Наем рабочих');
        return View::make('workers.hire');
    }

    public function get_finish()
    {
        return View::make('workers.finish');
    }

    // @TODO: фильтры для вводимых данных - не нужны, т. к. fluent фильтрует все автоматически.
    // разве что фильтры в смысле на корректность? ну дак их можно сделать на клиенте, а всякие 
    // экспериментаторы будут просто получать нулевой результат.
    public function post_search()
    {
        // сбрасываем все из массива в переменные
        extract(Input::all());
        $query_users = User::query();

        if( isset($rating) && !empty($rating)  )
            $query_users->where('rating' ,'>=', $rating);

        if( $gender !== '' )
            $query_users->where('gender' ,'=', $gender);

        if( !empty($created_at) )
            $query_users->where('created_at', '>=', $created_at);

        if( !empty($age_min) )
            $query_users->where('age' ,'>=', $age_min);

        if( !empty($age_max) )
            $query_users->where('age' ,'<=', $age_max);

        if( !empty($name) )
            $query_users->where('name', 'ILIKE', '%'.$name.'%');

        if( isset($team) && $team !== '' )
            $query_users->where('team' ,'=', $team);

        if( !empty($jobtype_id) ){
            $query_users->join('jobtype_user', 'users.id', '=', 'jobtype_user.user_id')
                ->where('jobtype_user.jobtype_id', '=', $jobtype_id);

            if(!empty($cost_min) )
                $query_users->where('jobtype_user.cost', '>=', $cost_min);

            if(!empty($cost_max))
                $query_users->where('jobtype_user.cost', '<=', $cost_max);
        }

        if(!empty($sort_criteria))
            $query_users->order_by('users.'.$sort_criteria, $sort_order);

        $workers = $query_users->paginate(self::$per_page);
        return Response::json($workers);
    }

    public function post_confirm()
    {
        $validation = Validator::make(Input::all(), self::$hire_validation);   
        if($validation->fails()) {
            return Redirect::to('workers/hire')->with_errors($validation->errors)->with_input();
        }
        $chosen_ids = Session::get('chosen_workers');
        if(empty($chosen_ids)) {
            return Redirect::to('workers')->with('no_chosen_error', 'Выберите хотя бы одного рабочего');
        }
        $job = new Job(array(
            'name'          => Input::get('name'),
            'phone'         => User::trim_phone(Input::get('phone')),
            'jobtype_id'    => Input::get('jobtype_id'),
            'place'         => Input::get('place'),
            'time_start'    => Input::get('time_start'),
            'time_end'      => Input::get('time_end'),
            'price'         => Input::get('price'),
        ));
        if( Auth::check() ) {
            Auth::user()->posted_jobs()->insert($job);
        } else {
            $job->save();
        }
        $job->workers()->sync($chosen_ids);
        Sms::job_notifications($job->id);
        Session::forget('chosen_workers');
        return Redirect::to('workers/finish');
    }

    public function get_chosen()
    {
        if(Session::has('chosen_workers')) {
            $ids    = Session::get('chosen_workers');
            if($ids) {
                $users  = User::where_in('id', $ids)->get();
                return Response::json(array(
                    'ids'   => $ids,
                    'chosen' => $users,
                ));
            }
        }
        return Response::json(array());
    }

    public function post_chosen($id = '')
    {
        $user = User::find($id);
        if($user) {
            $arr = Session::get('chosen_workers');
            $arr[] = $id;
            Session::put('chosen_workers', array_unique($arr));
            return Response::json(array('added' => true));
        }
        return Response::json(array('added' => false));
    }

    public function delete_chosen($id = '')
    {
        if($id == 'all') {
            Session::forget('chosen_workers');
            return Response::json(array('flushed' => true));
        }
        $arr = Session::get('chosen_workers');
        $pos = array_search($id, $arr);
        array_splice($arr, $pos, 1);
        Session::put('chosen_workers', $arr);
        return Response::json(array('deleted' => true));
    }


    public function  get_profile($id){
        $user = User::find($id);
        $avatar = $user->getAvatar();
        $jobtypes =  $user->jobtypes()->pivot()->get();

        return View::make('workers.view')->with( array('user' => $user, 'avatar'=>$avatar,'jobtypes'=>$jobtypes) );
    }
}
