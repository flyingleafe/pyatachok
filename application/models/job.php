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
        return $this->belongs_to('Jobtype');
    }

    public static function url($id)
    {
        return URL::to("jobs/id/$id");
    }

    public function get_phone()
    {
        $phone = $this->get_attribute('phone');
        if(User::validate_phone($phone)) {
            return '+7' . User::trim_phone($phone);
        }
        return $phone;
    }
}
