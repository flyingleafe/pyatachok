<?php

class Workers_Controller extends Base_Controller {

    private static $per_page = 10;

    public function __construct(){
        Asset::add('jquery', 'js/jquery-1.9.1.js');

        Asset::add('jquery_ui', 'js/jquery-ui-1.10.1.custom.js');
        Asset::add('jquery_ui_css', 'css/ui-lightness/jquery-ui-1.10.1.custom.css');

        Asset::add('chosen_js', 'chosen/chosen.jquery.js');
        Asset::add('chosen_css', 'chosen/chosen.css');
    }


	public function action_index()
	{
		return View::make('workers.index');
	}


    //@TODO: фильтры для вводимых данных
    public function action_search(){
        if (Request::ajax()) {
            $rating  = Input::get('rating' );

            $age_min  = Input::get('age_min' );
            $age_max  = Input::get('age_max' );

            $gender  =  Input::get('gender' );
            $name = Input::get('name');
            $team =   Input::get('team');
            $jobtype_id = Input::get('jobtype_id');
            $created_at = Input::get('created_at');

            $cost_min = Input::get('cost_min');
            $cost_max = Input::get('cost_max');

            $query_users = DB::table('users');

            if(  $rating  || $rating!==''  ){
                $query_users ->where('rating' ,'>=', $rating);
            }

            if( $gender || $gender!==''){
                $query_users->where('gender' ,'=', $gender);
            }

            if($created_at || $created_at!=='' ){

                $query_users->where('created_at', '>=', $created_at);
            }

            if( $age_min || $age_min!=='' )
                $query_users->where('age' ,'>=', $age_min);

            if( $age_max || $age_max!=='' )
                $query_users->where('age' ,'<=', $age_max);




            if(  $name || $name!==''   ){

                $query_users->where('name' ,'LIKE', '%'.Input::get('name').'%');
            }


            if( $team || $team!==''){
                $query_users->where('team' ,'=', $team );
            }



            if($jobtype_id || $jobtype_id!==''){
                $users = $query_users->get( array('id'));
                $user_ids = array();
                foreach($users as $user)  array_push($user_ids, $user->id);
                $workers = DB::table('users')
                    ->join('jobtype_user', 'users.id','=', 'jobtype_user.user_id')
                    ->where_in('users.id', $user_ids)
                    ->where('jobtype_user.jobtype_id', '=', $jobtype_id)
                    ->distinct();


                if($cost_min ||  $cost_min!=='' ){
                    $workers->where('jobtype_user.cost', '>=', $cost_min);
                }

                if($cost_max ||  $cost_max!==''){
                    $workers->where('jobtype_user.cost', '<=', $cost_max);

                }

                echo $workers->sql();

                $workers = $workers->paginate(self::$per_page, array('users.id', 'users.phone', 'users.name','jobtype_user.cost', 'jobtype_user.jobtype_id'));
                //return Response::make(View::make('workers.search')->render(), 200, array('workers'=> $workers));
                //echo render('workers.search',array('workers'=> $workers) );

                return render('workers.search', array( 'workers' => $workers));

            }

            $workers = $query_users->paginate(self::$per_page);

            return render('workers.search', array( 'workers' => $workers));
            //return View::Make('workers.search')->with('workers', $workers);
        }
        //return View::Make('workers.index')->with('workers', $workers);
    }




}
