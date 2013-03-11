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
            $table->boolean('status'); //  0 - закрытая (работодатель набрал рабочих сам), 1 - открытая (выставил на всеобщее обозрение)
            $table->integer('target_count')->nullable(); //  target_count (integer) (nullable) - для открытых работ: кол-во рабочих, необходимых для работы.
        });

        //отношения работ и рабочих, принявших участие (many-to-many)
        Schema::create('job_user', function($table) {
            $table->integer('id');
            $table->integer('worker_id'); //id рабочего
            $table->integer('job_id'); //id работы
            $table->primary(array('worker_id', 'job_id')); //составной ключ
        });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('jobs');
        Schema::drop('job_user');
	}

}