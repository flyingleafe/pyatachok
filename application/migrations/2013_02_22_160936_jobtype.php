<?php

class Jobtype {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
		public function up()
	{
		Schema::create('Jobtypes', function($table) {
			$table->increments('id');
			$table->string('name', 255);
		});

        Schema::create('user_jobtype', function($table) {
			$table->increments('jobtype_id');
			$table->integer('user_id');

		});

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Jobtypes');
		Schema::drop('user_jobtype');
	}

}