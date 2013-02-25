

<?php

class Admin_Users_Controller extends Base_Controller {

    public $layout = 'admin';

    public function action_index(){

        return View::make('admin.users.index');

    }

}