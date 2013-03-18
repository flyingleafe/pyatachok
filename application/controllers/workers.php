<?php

class Workers_Controller extends Base_Controller {
    public $resful = true;

    private static $per_page = 10;

    public function __construct(){
        Asset::add('jquery', 'js/jquery-1.9.1.js');

        Asset::add('jquery_ui', 'js/jquery-ui-1.10.1.custom.js');
        Asset::add('jquery_ui_css', 'css/ui-lightness/jquery-ui-1.10.1.custom.css');

        Asset::add('chosen_js', 'chosen/chosen.jquery.js');
        Asset::add('chosen_css', 'chosen/chosen.css');
    }


	public function action_index(){
		return View::make('workers.index');
	}

    public function get_search(){
		return View::make('workers.index');
	}


    public static function not_empty($param){
        return ($param || $param!='') ? true : false;
    }

    //@TODO: фильтры для вводимых данных
    public function action_search(){
        //if (Request::ajax()) {

            $rating     = Input::get('rating' );
            $age_min    = Input::get('age_min' );
            $age_max    = Input::get('age_max' );
            $gender     = Input::get('gender' );
            $name       = Input::get('name');
            $team       = Input::get('team');
            $jobtype_id = Input::get('jobtype_id');
            $created_at = Input::get('created_at');
            $cost_min   = Input::get('cost_min');
            $cost_max   = Input::get('cost_max');

            $query_users = DB::table('users');

            if( self::not_empty($rating)  )
                $query_users ->where('rating' ,'>=', $rating);


            if( self::not_empty($gender) )
                $query_users->where('gender' ,'=', $gender);

            if( self::not_empty($created_at) )
                $query_users->where('created_at', '>=', $created_at);

            if( self::not_empty($age_min) )
                $query_users->where('age' ,'>=', $age_min);

            if( self::not_empty($age_max) )
                $query_users->where('age' ,'<=', $age_max);

            if( self::not_empty($name) )
            $query_users->where('name' ,'LIKE', '%'.$name.'%');

            if( self::not_empty($team) )
                $query_users->where('team' ,'=', $team );

            if( self::not_empty($jobtype_id) ){
                $users = $query_users->get( array('id'));
                $user_ids = array();
                foreach($users as $user)  array_push($user_ids, $user->id);
                $workers = DB::table('users')
                    ->join('jobtype_user', 'users.id','=', 'jobtype_user.user_id')
                    ->where_in('users.id', $user_ids)
                    ->where('jobtype_user.jobtype_id', '=', $jobtype_id)
                    ->distinct();


                if(self::not_empty($cost_min) )
                    $workers->where('jobtype_user.cost', '>=', $cost_min);


                if(self::not_empty($cost_max))
                    $workers->where('jobtype_user.cost', '<=', $cost_max);

               $workers = $workers->paginate(self::$per_page,
                    array(
                        'users.id',
                        'users.phone',
                        'users.name',
                        'jobtype_user.cost',
                        'jobtype_user.jobtype_id')
                );

                return render('workers.search', array( 'workers' => $workers));
            }

            $page = Input::get('page', 1);
            $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;

            $total = $query_users->count();
            $results = $query_users
                ->for_page($page, static::$per_page)
                ->get();

             //$workers = $query_users->paginate(self::$per_page);
            $workers = Paginator::make($results, $total, static::$per_page);
            return render('workers.search', array( 'workers' => $workers));
        }
    //}




}
