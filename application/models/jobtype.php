<?php

class Jobtype extends Eloquent {

    public static $timestamps = true;

    public static $jobtype_add_rules = array(
        'name' => 'required|unique:jobtypes|max:64|min:6',
    );

    public static $jobtype_edit_rules = array(
        'name' => 'required|max:64|min:6',
    );

    // bob generates these relationships using the 'has_and_belongs_to_many' method
    // name instead of the new name (changed in March I believe) to 'has_many_and_belongs_to'.
	public function users()
	{
		return $this->has_many_and_belongs_to('User', 'jobtype_user')->with('cost');
	}

    //Преобразуем в нижний регистр
    public function set_name($name){
        $this->set_attribute('name', $this->strtolower_utf8($name));
    }



    static function strtolower_utf8($text){
        $text = mb_convert_case($text, MB_CASE_LOWER, "UTF-8");
        return $text;
    }


    //Вернуть с заглавной первой буквой
    public function get_name(){
       return  ucfirst($this->get_attribute('name'));
    }
}
