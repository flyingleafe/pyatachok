<?php

class Jobs {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('jobs', function($table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->nullable(); //id работадателя
            $table->integer('jobtype_id');
            $table->integer('price');
            $table->string('phone')->nullable(); //если работадатель null - то !nullable
            $table->text('description')->nullable();
            $table->string('place');
            $table->timestamp('time_start');
            $table->timestamp('time_end');
            $table->string('name')->nullable(); // name (имя работодателя) [nullable if(user_id) ]
            $table->boolean('status')->default(0); //  0 - закрытая (работодатель набрал рабочих сам), 1 - открытая (выставил на всеобщее обозрение)
            $table->integer('target_count')->nullable(); //  target_count (integer) (nullable) - для открытых работ: кол-во рабочих, необходимых для работы.
        });

        //отношения работ и рабочих, принявших участие (many-to-many)
        Schema::create('job_user', function($table) {
            $table->integer('id');
            $table->integer('user_id'); //id рабочего
            $table->integer('job_id'); //id работы
            $table->primary(array('user_id', 'job_id')); //составной ключ

        });

        $this->work_generator();


	}

    public function work_generator(){

        $users = DB::table('users')->get();
        $jobtypes = DB::table('jobtypes')->get();

        for($i=0; $i<400; $i++) {
            $user = array_rand($users);
            $jobtype = array_rand($jobtypes);

            DB::table('jobs')->insert(
                array(
                    'user_id' => $user ,
                    'jobtype_id' => $jobtype ,
                    'price' => rand(1000, 10000),
                    'phone' => '9045656576',
                    'description'=>'Крутая работка',
                    'place'=>'Северо-западый переулок, дом 45',
                    'name'=>'4545sgsdf',
                    'time_start'=>date('Y-m-d H:i:s'),
                    'time_end'=>date('Y-m-d H:i:s'),
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
        Schema::drop('job_user');
        Schema::drop('jobs');
	}

}