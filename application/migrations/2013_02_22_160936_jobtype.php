<?php

class Jobtype {

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('jobtypes', function($table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 255);
        });



        Schema::create('jobtype_user', function($table) {
            $table->integer('id')->nullable();
            $table->integer('jobtype_id');
            $table->integer('user_id');
            $table->integer('cost');
            $table->primary(array('jobtype_id', 'user_id')); //составной ключ

        });


        $jobtype_action = array(
            'Мытьё',
            'Чистка',
            'Уборка',
            'Разгрузка',
            'Сборка',
            'Активация',
            'Уничтожение',
            'Перевозка',
            'Загрузка',
            'Покраска',
        );

        $jobtype_object = array(
            'окон',
            'помещений',
            'наркоты',
            'хомячков',
            'дверей',
            'складов',
            'стен',
            'труб',
            'офисов',
            'деревьев',
            'тюленей',
        );

        $jobtypes = array();
        for($i=0; $i<400; $i++){
            $rand_act = array_rand($jobtype_action);
            $rand_obj = array_rand($jobtype_object);
            $jobtypes[$jobtype_action[$rand_act].' '.$jobtype_object[$rand_obj]] = $jobtype_action[$rand_act].' '.$jobtype_object[$rand_obj];
        }

        foreach($jobtypes as $jobtype) {
            DB::table('jobtypes')->insert(
                array(
                    'name' => $jobtype,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                )
            );
        }


    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('jobtypes');
       Schema::drop('jobtype_user');

    }



}