<?php

class User extends Eloquent {

	public static $timestamps = true;

	public function jobtypes()
	{
		return $this->has_many_and_belongs_to('Jobtype', 'user_jobtype');
	}

}
