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
			$table->string('name_and_surname')->nullable();
			$table->drop_column('name');
			$table->drop_column('surname');
			$table->text('about')->nullable();
			$table->integer('status')->default(0);  //это статус 0 неподтвержденный, 1- незаполненный, 2 - уже в поиске
			$table->boolean('is_worker')->default(true); //true -рабочий, false - работодатель
			$table->string('avatar_url')->nullable();


		});
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