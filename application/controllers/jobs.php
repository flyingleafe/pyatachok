<?php

class Jobs_Controller extends Base_Controller {

    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'user_ready')->on('get');
        $this->filter('before', 'csrf')->on('post');

        Asset::add('jquery', 'js/jquery-1.9.1.js');

        Asset::add('jquery_ui', 'js/jquery-ui-1.10.1.custom.js');
        Asset::add('jquery_ui_css', 'css/ui-lightness/jquery-ui-1.10.1.custom.css');

        Asset::add('chosen_js', 'chosen/chosen.jquery.js');
        Asset::add('chosen_css', 'chosen/chosen.css');

        Asset::add('jquery-ui-sliderAccess', 'js/jquery-ui-sliderAccess.js');
        Asset::add('jquery-ui-timepicker', 'js/jquery-ui-timepicker-addon.js');
        Asset::add('jquery-ui-timepicker-ru', 'js/jquery-ui-timepicker-ru.js');
    }

	public function get_index()
	{
		// code here..

		return View::make('jobs.index');
	}

    public function get_create(){
        return View::make('jobs.create');
    }

    public function post_create(){


    }

}
