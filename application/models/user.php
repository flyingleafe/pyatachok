<?php

class User extends Eloquent {

	public static $timestamps = true;

	public function jobtypes()
	{
		return $this->has_many_and_belongs_to('Jobtype')->with('cost');
    }

    public function set_password($password)
    {
        $this->set_attribute('password', Hash::make($password));
    }

}
