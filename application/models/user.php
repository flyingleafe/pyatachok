<?php

class User extends Eloquent {

	public static $timestamps = true;

	public function jobtypes()
	{
		return $this->has_and_belongs_to_many('Jobtype');
	}

}
