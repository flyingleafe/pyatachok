<?php

class Default_Admin {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$admin = new User;
		$admin->phone = 'admin';
		$admin->password = '29b2957f';
		$admin->role = 1;
		$admin->save();
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$admin = User::where_phone('admin')->first();
		$admin->delete();
	}

}