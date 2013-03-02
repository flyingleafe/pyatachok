<?php

class Users_Foreign_Indexes {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobtype_user', function($table)
		{
			$table->foreign('user_id')->references('id')->on('users')->on_delete('cascade')->on_update('cascade');
			$table->foreign('jobtype_id')->references('id')->on('jobtypes')->on_delete('cascade')->on_update('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jobtype_user', function($table)
		{
			$table->drop_foreign('jobtype_user_user_id_foreign');
			$table->drop_foreign('jobtype_user_jobtype_id_foreign');		
		});
	}

}