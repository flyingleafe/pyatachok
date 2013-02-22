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
			$table->string('name');
			$table->text('about');
			$table->integer('status')->default(false);
			$table->boolean('is_worker')->default(true);
			$table->string('avatar_url');
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