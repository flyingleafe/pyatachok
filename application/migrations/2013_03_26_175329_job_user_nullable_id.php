<?php

class Job_User_Nullable_Id {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		/*Schema::table('job_user', function($table)
		{
			$table->drop_column('id');
			// $table->integer('id')->nullable();
		});*/
		DB::query('ALTER TABLE "job_user" ADD COLUMN "id" SERIAL NOT NULL');
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		// троебучий increments насильно добавляет primary key, хотя он не нужен тут!
		Schema::table('job_user', function($table)
		{
			$table->drop_column('id');
		    // $table->increments('id');
		});
	}

}