<?php

class Users extends Eloquent {

	public static $timestamps = true;

	public function tasks()
	{
		return $this->has_and_belongs_to_many('Task');
	}

	public function feedbacks()
	{
		return $this->has_many('Feedback');
	}

}
