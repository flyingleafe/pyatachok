<?php

class Job extends Eloquent {

    public static $timestamps = true;

    public function employer()
    {
        return $this->has_one('User');
    }

	public function workers()
    {
        return $this->has_many_and_belongs_to('User');
	}

    public function jobtype()
    {
        return $this->has_one('Jobtype');
    }
}
