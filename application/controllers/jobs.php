<?php

class Jobs_Controller extends Base_Controller {

    public $restful = true;

    private static $date_regexp = '/(\d{2})-([А-я]{3,7})-(\d{4}) (\d{2}):(\d{2})/ui';

    public static $for_register = array(
        'phone' => 'required|valid_phone',
        'price'=>'required',
        'description'=>'required',
        'place'=>'required',
        'time_start'=>'required',
        'time_end'=>'required',
        'target_count'=>'required',
        'jobtype_id'=>'required',
    );

    public static $for_guest = array();

    public function __construct()  {

        Asset::add('jquery', 'js/jquery-1.9.1.js');
        Asset::add('jquery_ui', 'js/jquery-ui-1.10.1.custom.js');
        Asset::add('jquery_ui_css', 'css/ui-lightness/jquery-ui-1.10.1.custom.css');
        Asset::add('chosen_js', 'chosen/chosen.jquery.js');
        Asset::add('chosen_css', 'chosen/chosen.css');
        Asset::add('jquery-ui-sliderAccess', 'js/jquery-ui-sliderAccess.js');
        Asset::add('jquery-ui-timepicker', 'js/jquery-ui-timepicker-addon.js');
        Asset::add('jquery-ui-timepicker-ru', 'js/jquery-ui-timepicker-ru.js');
        Asset::add('search', 'js/search.js');
    }

	public function get_index(){

		return View::make('jobs.index');
	}

    public function get_add(){
        return View::make('jobs.type');
    }


    //@TODO: фильтры для вводимых данных
    public function post_search(){
        $jobtype_id = Input::get('jobtype_id');
        $date_start    = Input::get('date_start' );
        $date_end    = Input::get('date_end' );
        $cost_min   = Input::get('cost_min');
        $cost_max   = Input::get('cost_max');

        $query_jobs = DB::table('jobs');


        /*if( !empty($name) )
            $query_jobs->where('name' ,'LIKE', '%'.$name.'%');
        */

        if( !empty($jobtype_id) ){
            $query_jobs->where('jobtype_id', '=', $jobtype_id );


            if(!empty($cost_min) )
                $query_jobs->where('price', '>=', $cost_min);

            if(!empty($cost_max))
                $query_jobs->where('price', '<=', $cost_max);

        }

        $jobs = $query_jobs->get();
        return render('jobs.search', array( 'jobs' => $jobs));
    }

    public function post_add(){

        $job_type    = Input::get('job_type');

        $job = new Job();

        if (Auth::check()){
            $user = Auth::user();
            $job->user_id = $user->id;
            $job->name = $user->name;
            $job->phone = $user->phone;
        }

        $job->status = $job_type;

        Session::put('job', $job);

        return View::make('jobs.create', array('model'=>$job) );

    }

    public function post_create(){

        $job = Session::get('job');

        $validation = Validator::make(Input::all(), self::$for_register);

        if($validation->fails()){
            return View::make('jobs.create', array('errors'=>$validation->errors, 'model'=>$job));
        }

        $phone          = Input::get('phone');
        $jobtype_id     = Input::get('jobtype_id');
        $price          = Input::get('price');
        $description    = Input::get('description');
        $place          = Input::get('place');
        $time_start     = self::return_timestamp(Input::get('time_start'));
        $time_end       = self::return_timestamp(Input::get('time_end'));
        $target_count   = Input::get('target_count');

        $job->fill(array(
            'phone' => $phone,
            'jobtype_id' => $jobtype_id,
            'price' => $price,
            'description' => $description,
            'place' => $place,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'target_count' => $target_count,
        ));

        $job->save();
        return Redirect::to('profile');
    }


    private static function  return_timestamp($date){
        $months =  array(
            'Январь'    => '01',
            'Февраль'   => '02',
            'Март'      => '03',
            'Апрель'    => '04',
            'Май'       => '05',
            'Июнь'      => '06',
            'Июль'      => '07',
            'Август'    => '08',
            'Сентябр'   => '09',
            'Октябрь'   => '10',
            'Ноябрь'    => '11',
            'Декабрь'   => '12',
        );
        preg_match(self::$date_regexp, $date, $matches);
        $months_name = (array_key_exists ($matches[2], $months)) ? $months[$matches[2]] : false;

        if(count($matches)==6 && $months_name){
            //2013-03-10 01:05:46 - timestamp format example
            return $matches[3].'-'.$months_name.'-'.$matches[1].' '.$matches[4].':'.$matches[5].':00';
        }
        return false;
   }

}
