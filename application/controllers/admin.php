<?php

class Admin_Controller extends Base_Controller {


    public function action_users(){

        return View::make('admin.users.index');

    }

}

?>