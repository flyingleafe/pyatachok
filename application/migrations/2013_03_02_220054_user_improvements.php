<?php

class User_Improvements {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			// fLf: прописал дефолтное значение, без него херня
			// $table->drop_column('gender');
			$table->integer('age')->unsigned()->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			$table->drop_column('age');
		});
	}

}