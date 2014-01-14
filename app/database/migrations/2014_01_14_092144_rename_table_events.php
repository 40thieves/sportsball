<?php

use Illuminate\Database\Migrations\Migration;

class RenameTableEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Update table name to eventType
		Schema::rename('event','eventType');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Revert table name to event
		Schema::rename('eventType','event');
	}

}