<?php

class User_Improvements {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// fLf: Андрей, не обращай внимания на эту хрень, я тут долго и нудно мигрировал туда-сюда
		Schema::table('users', function($table)
		{
			// fLf: прописал дефолтное значение, без него херня
			// $table->drop_column('gender');
			// $table->integer('age')->unsigned()->nullable();
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
			// $table->drop_column('age');
		});
	}

}