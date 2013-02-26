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

        Schema::create('user_jobtype', function($table) {
            // fLf: Андрей, здесь был косяк: ID работы не может быть инкрементом, он же задает отношение к
            // элементу в таблице работ. Еще добавил поле cost - помнишь, о нем говорили?
            $table->integer('id')->nullable(); //как убрать Id? он не нужен, как искать по составному ключу?
            $table->primary(array('jobtype_id', 'user_id')); //составной ключ


            $table->timestamps();
            $table->integer('jobtype_id');
            $table->integer('user_id');

            $table->integer('cost');
        });

    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobtypes');
        Schema::drop('user_jobtype');
    }

}