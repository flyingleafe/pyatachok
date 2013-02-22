<?php

class Jobtype extends Eloquent {

	public function users()
	{
		return $this->has_and_belongs_to_many('User');
	}

}
