<?php

class Jobtype extends Eloquent {

    public static $timestamps = true;

    // bob generates these relationships using the 'has_and_belongs_to_many' method
    // name instead of the new name (changed in March I believe) to 'has_many_and_belongs_to'.

	public function users()
	{
		return $this->has_many_and_belongs_to('User', 'jobtype_user')->with('cost');
	}

}
