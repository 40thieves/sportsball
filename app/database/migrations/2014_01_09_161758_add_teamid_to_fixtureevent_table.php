<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamidToFixtureeventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Add teamID attribute to fixtureEvent table
		Schema::table('fixtureEvent', function(Blueprint $table) {
			$table
				->integer('teamID')
				->nullable()
				->after('eventID')
				;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Remove teamID attribute from fixtureEvent table
		Schema::table('fixtureEvent', function(Blueprint $table) {
			$table->dropColumn('teamID');
		});
	}

}