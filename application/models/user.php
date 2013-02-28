<?php

class User extends Eloquent {

	public static $timestamps = true;

	public function jobtypes()
	{
        //прежде чем стирать, наверно надо протестить, что работает??
		return $this->has_many_and_belongs_to('Jobtype', 'user_jobtype')->with('cost');
	}

    public function set_password($password)
    {
        $this->set_attribute('password', Hash::make($password));
    }





}
