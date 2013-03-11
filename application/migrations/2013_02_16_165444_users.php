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

			$table->string('phone', 11)->unique();
			$table->string('password');
            $table->string('name')->nullable();

			$table->text('about')->nullable();
			$table->integer('status')->default(0);  //это статус 0 неподтвержденный, 1- незаполненный, 2 - уже в поиске
			$table->boolean('is_worker')->default(true); //true -рабочий, false - работодат.

            $table->boolean('gender')->default(1); //пол - 0 женщина, 1 мужчина

            // fLf: мне кажется, что бригаду тоже надо будет делать отдельной моделью,
            // с которой будет отношение has_one
            $table->boolean('team')->default(0); //бригада - 0 состоит, 1 нет
            $table->integer('rating')->default(0); //рейтинг
            $table->integer('age')->nullable(); //возраст

			$table->string('avatar_url')->nullable();

		});


        for($i=0; $i<50; $i++) {
            $person = $this->person_generator();
            User::create(
                array(
                    'phone'      => $this->phone_generate(),
                    'password'   => 1234,
                    'gender'     => $person[0],
                    'rating'     => rand(1, 9999),
                    'team'       => rand(0,1),
                    'name'       => $person[1],
                    'is_worker'  => rand(1,0),
                    'age'        => $person[2],
                    'status'     => rand(-1, 2),
                )
            );
        }
	}


    public function phone_generate(){
        return '9'.substr(number_format(time() * rand(),0,'',''),0,9);
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
            'Соловьев',
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
                return array(1, $male_names[$rand_name].' '.$surnames[$rand_surname], rand(18, 70)) ;
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