<?php

class Job extends Eloquent {

    public static $timestamps = true;


	public function users()	{

        return $this->has_many_and_belongs_to('user')
            ->with('jobtype_id')
            ->with('price')
            ->with('description')
            ->with('place')
            ->with('time_start')
            ->with('time_end')
            ->with('name')
            ->with('status')
            ->with('target_count');
	}

}
