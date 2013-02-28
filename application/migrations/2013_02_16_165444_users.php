<?php

class Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->timestamps();

			$table->string('phone', 11);
			$table->string('password');
            $table->string('name')->nullable();

			$table->text('about')->nullable();
			$table->integer('status')->default(0);  //это статус 0 неподтвержденный, 1- незаполненный, 2 - уже в поиске
			$table->boolean('is_worker')->default(true); //true -рабочий, false - работодат.

            $table->boolean('gender'); //пол - 0 женщина, 1 мужчина
            $table->boolean('team')->default(0); //бригада - 0 состоит, 1 нет
            $table->integer('rating')->default(0); //рейтинг
            $table->integer('age'); //возраст

			$table->string('avatar_url')->nullable();

		});


        for($i=0; $i<50; $i++) {
            $person = $this->person_generator();
            DB::table('users')->insert(
                array(
                    'phone' => $this->phone_generate(),
                    'password' =>  Hash::make(1234),
                    'gender'=> $person[0],
                     'rating' => rand(1, 9999),
                    'team'=>rand(0,1),
                    'name' => $person[1],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'is_worker'=> rand(1,0),
                    'age'=>$person[2],
                    'status'=> rand(-1, 2),
                )
            );
        }
	}


    public function phone_generate(){
        return (int) '9'.rand(10, 55).rand(100,999).rand(56, 99).rand(66, 99);
    }

    public function person_generator(){
        $female_names = array(
            'Наталья',
            'Евгения',
            'Катерина',
            'Марина',
            'Ольга',
            'Александра',
            'Дарья',
            'Яна',
            'Полина',
            'Людмила',
            'Кира',
            'Елена',
            'Ева',
            'Анастасия',
            'Алла',
            'Алиса',
            'Анна',
            'Диана',
            'Инна',
            'Ника',
        );

        $surnames = array(
            'Иванов',
            'Иванов',
            'Смирнов',
            'Кузнецов',
            'Попов',
            'Соколов',
            'Лебедев',
            'Козлов',
            'Новиков',
            'Морозов',
            'Петров',
            'Волков',
            'Соловаьев',
            'Васильев',
            'Зайцев',
            'Павлов',
            'Семенов',
            'Голубев',
            'Виноградов',
            'Воробьев',
            'Федоров',
            'Михайлов',
            'Беляев',
            'Тарасов',
            'Белов',
            'Комаров',
            'Орлов',
            'Киселев',
            'Макаров',
            'Андреев',
            'Ковалёв',

        );

        $male_names = array(
            'Василий',
            'Никита',
            'Алексадр',
            'Петр',
            'Вячеслав',
            'Антон',
            'Валерий',
            'Валерий',
            'Артур',
            'Альберт',
            'Егор',
            'Степан',
            'Ян',
            'Ашот',
            'Зигмунд',
        );

        $gender = rand (0,1);
        switch($gender) {
            case 0:
                $rand_name = array_rand($female_names,1);
                $rand_surname = array_rand($surnames,1);
                return array(0, $female_names[$rand_name].' '.$surnames[$rand_surname].'a', rand(18, 70)) ;
            case 1:
                $rand_name = array_rand($male_names,1);
                $rand_surname = array_rand($surnames,1);
                return array(0, $male_names[$rand_name].' '.$surnames[$rand_surname], rand(18, 70)) ;
        }
    }
	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}