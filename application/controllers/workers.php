<?php

class Workers_Controller extends Base_Controller {

    public $restful = true;

    private static $per_page = 10;

    public function __construct(){
        Asset::add('jquery', 'js/jquery-1.9.1.js')
            ->add('jquery_ui', 'js/jquery-ui-1.10.1.custom.js')
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
        // return render('workers.search', array( 'workers' => $workers, 'has_jobtype' => !empty($jobtype_id) ) );
        return Response::json($workers);
    }

    public function get_chosen()
    {
        if(Session::has('chosen_workers')) {
            $ids    = Session::get('chosen_workers');
            $users  = User::where_in('id', $ids)->get();
            return Response::json(array(
                'ids'   => $ids,
                'users' => $users,
            ));
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
        $arr = Session::get('chosen_workers');
        $pos = array_search($id, $arr);
        array_splice($arr, $pos, 1);
        Session::put('chosen_workers', $arr);
        return Response::json(array('deleted' => true));
    }
}
