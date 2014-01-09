<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamidForeignKeysForFixtureEvent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create teamID foreign key for fixtureEvent table
		Schema::table('fixtureEvent', function(Blueprint $table) {
			$table->foreign('teamID')->references('teamID')->on('team');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Removes teamID foreign key on fixture table
		Schema::table('fixtureEvent', function(Blueprint $table) {
			$table->dropForeign('teamID');
		});
	}

}