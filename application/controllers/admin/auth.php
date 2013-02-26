<?php

class Admin_Auth_Controller extends Base_Controller {



    public function action_index(){

        return View::Make('admin.auth');
    }


}