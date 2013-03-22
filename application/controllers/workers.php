<?php

class Workers_Controller extends Base_Controller {

    public $restful = true;

    private static $per_page = 10;

    public function __construct(){
        Asset::add('jquery', 'js/jquery-1.9.1.js');

        Asset::add('jquery_ui', 'js/jquery-ui-1.10.1.custom.js');
        Asset::add('jquery_ui_css', 'css/ui-lightness/jquery-ui-1.10.1.custom.css');

        Asset::add('chosen', 'chosen/chosen.jquery.js', 'jquery');
        Asset::add('chosen_css', 'chosen/chosen.css');
        Asset::add('workers-search', 'js/workers-search.js', 'chosen');
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

    //@TODO: фильтры для вводимых данных - не нужны, т. к. fluent фильтрует все автоматически.
    // разве что фильтры в смысле на корректность? ну дак их можно сделать на клиенте, а всякие 
    // экспериментаторы будут просто получать нулевой результат.
    public function post_search()
    {
        // сбрасываем все из массива в переменные
        extract(Input::all());
        var_dump(Input::all());

        $query_users = User::query();

        if( !empty($rating)  )
            $query_users->where('rating' ,'>=', $rating);

        if( !empty($gender) )
            $query_users->where('gender' ,'=', $gender);

        if( !empty($created_at) )
            $query_users->where('created_at', '>=', $created_at);

        if( !empty($age_min) )
            $query_users->where('age' ,'>=', $age_min);

        if( !empty($age_max) )
            $query_users->where('age' ,'<=', $age_max);

        if( !empty($name) )
            $query_users->where('name', 'ILIKE', '%'.$name.'%');

        if( !empty($team) )
            $query_users->where('team' ,'=', (int) $team);

        if( !empty($jobtype_id) ){
            $query_users->join('jobtype_user', 'users.id','=', 'jobtype_user.user_id')
                ->where('jobtype_user.jobtype_id', '=', $jobtype_id)
                ->distinct();

            if(!empty($cost_min) )
                $query_users->where('jobtype_user.cost', '>=', $cost_min);

            if(!empty($cost_max))
                $query_users->where('jobtype_user.cost', '<=', $cost_max);
        }

        $workers = $query_users->paginate(self::$per_page);
        return render('workers.search', array( 'workers' => $workers));
    }
}
