<?php

class Job extends Eloquent {

    public static $timestamps = true;


	public function users()	{

        return $this->has_many_and_belongs_to('user');
	}

}
