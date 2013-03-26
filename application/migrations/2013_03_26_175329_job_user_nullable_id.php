<?php

class Job_User_Nullable_Id {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('job_user', function($table)
		{
			$table->drop_column('id');
			// $table->integer('id')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('job_user', function($table)
		{
			// $table->drop_column('id');
		    $table->integer('id');
		});
	}

}