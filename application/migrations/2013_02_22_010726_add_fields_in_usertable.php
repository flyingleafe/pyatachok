<?php

class Add_Fields_In_Usertable {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table('users', function($table) {
            $table->string('username', 32);
            $table->string('email', 320);
            $table->string('password', 64);

		});
	}
		//


	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}