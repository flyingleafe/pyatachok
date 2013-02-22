<?php

class Register_Controller extends Base_Controller {

    public $restful = true;

    public static $rules = array(
        // fLf: регэксп несовершенен, нужно немного доработать\
        // unique будет работать не так немного, как хочется - все равно придется преобразовывать номер к стандартному виду
        'phone' => 'required|unique:users|match:/^(\+7|8)?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{2})[-. ]?([0-9]{2})$/',       
        'password' => 'required|max:64|min:6|confirmed',
    );

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
    }

    /**
     * Валидация данных
     * fLf: делай такие комменты, это делает код более красивым и информативным.
     * К тому же для будущих поколений нужна будет авто-документация.
     * @param  Array $data Правила валидации
     * @return Velidator       объект валидации
     */
    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

	public function get_index()
	{

        $input = Input::all();

		// code here..
        if(Auth::guest()) {
            return View::make('register.index');
        }
        return View::make('register.loggedin');
	}

    public function post_create(){

        $validation = self::validate(Input::All());

        if($validation->fails()){
            return Redirect::to('register')->with_errors($validation)->with_input();

        }
        Users::create(array(
            'username'=>Input::get('username'),
            'email'=>Input::get('email'),
            'name'=>Input::get('name'),
            'surname'=>Input::get('surname'),
            'password'=>Input::get('password'),
        ));

        return Redirect::to('/');
                //->with('message' , 'Вы успешно зарегестрированы!');


    }
}
