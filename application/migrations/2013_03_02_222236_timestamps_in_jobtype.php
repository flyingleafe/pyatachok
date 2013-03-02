<?php

class Timestamps_In_Jobtype {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobtype_user', function($table)
		{
			$table->timestamps();
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
		    $table->drop_column('created_at');
		    $table->drop_column('updated_at');
		});
	}

}