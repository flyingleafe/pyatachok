<?php

class Admin_Home_Controller extends Base_Controller {

    public function action_index() {
        return View::Make('admin::home');
    }
}