<?php

class Test_Controller extends Base_Controller {

	public function action_index()
	{
        var_dump(DB::connection('pgsql')->pdo);
		return View::make('test.index');
	}

}
