<?php

class Search_Controller extends Base_Controller {

    public function __construct(){
        Asset::add('jquery', 'js/jquery-1.9.1.js');
        Asset::add('chosenjs', 'chosen/chosen.jquery.js');
        Asset::add('chosencss', 'chosen/chosen.css');
        Asset::add('chosenprotojs', 'chosen/chosen.proto.js');

    }


    public function action_workers(){
        if(Request::method()=='POST'){
            //$input = Input::all();

            $job_ids = Input::get('job_ids[]');

            $result = DB::table('users');
            $rating  = Input::get('rating' );
            $age  = Input::get('age' );
            $gender  = Input::get('gender' );
            $name_and_surname = Input::get('name_and_surname');
            $team =  Input::get('team');

            if(  $rating  )
                $result ->where('rating' ,'>=', Input::get('rating'));


            if( $gender  )
                $result->where('gender' ,'>=', Input::get('gender'));

            if( $age  )
                $result->where('age' ,'>=', Input::get('age'));

            if(  $name_and_surname  )
                $result->where('name_and_surname' ,'LIKE', '%'.Input::get('name_and_surname').'%');

            $result->where('team' ,'=', $team );

            echo $result->count();

        }

        else {
            return View::Make('search.workers');
        }

    }


    public function action_employers(){
        return View::Make('search.employers');

    }

}
?>