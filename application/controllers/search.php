<?php

class Search_Controller extends Base_Controller {

    public $restful = true;

    public function __construct(){
        Asset::add('jquery', 'js/jquery-1.9.1.js');

        Asset::add('jquery_ui', 'js/jquery-ui-1.10.1.custom.js');
        Asset::add('jquery_ui_css', 'css/ui-lightness/jquery-ui-1.10.1.custom.css');

        Asset::add('chosen_js', 'chosen/chosen.jquery.js');
        Asset::add('chosen_css', 'chosen/chosen.css');
    }


    public function post_workers(){
        $rating  = Input::get('rating' );
        $age  = Input::get('age' );
        $gender  =  Input::get('gender' );

        $name_and_surname = Input::get('name');

        $team =   Input::get('team');

        $jobtype_id = Input::get('job_id');
        $created_at = Input::get('created_at');
        $cost_min = Input::get('cost_min');
        $cost_max = Input::get('cost_max');


        $query_users = DB::table('users');
        if(  $rating  )
            $query_users ->where('rating' ,'>=', $rating);


        if( $gender || $gender!==''){
            $query_users->where('gender' ,'=', $gender);
        }

        if($created_at){

            $query_users->where('created_at', '>=', $created_at);
        }

        if( $age  )
            $query_users->where('age' ,'>=', $age);

        if(  $name_and_surname  ){

            $query_users->where('name' ,'LIKE', '%'.Input::get('name').'%');
        }


        if( $team || $team!==''){
            $query_users->where('team' ,'=', $team );
        }

        if($cost_min){
            $query_users->where('cost', '>=', $cost_min);
        }

        if($cost_max){
            $query_users->where('cost', '<=', $cost_max);

        }

        if($jobtype_id){

            $users = (array) $query_users->get( array('id'));
            $user_ids = array();
            foreach($users as $user)  array_push($user_ids, $user->id);

            $workers = DB::table('users')
                ->join('user_jobtype', 'users.id','=', 'user_jobtype.user_id')
                ->where_in('users.id', array_keys($user_ids))
                ->where('user_jobtype.jobtype_id', '=', $jobtype_id)
                ->distinct()
                ->get(array('users.id', 'users.phone', 'users.name','user_jobtype.cost', 'user_jobtype.jobtype_id'));

            return View::Make('search.workers')->with('workers', $workers);

        }


        $workers = $query_users->get();
        return View::Make('search.workers')->with('workers', $workers);
    }


    public function action_employers(){
        return View::Make('search.employers');

    }

}
?>