<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOngoingToFixtureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Add isOngoing attribute to fixture table
		Schema::table('fixture', function(Blueprint $table) {
			$table
				->string('isOngoing', 1)
				->nullable()
				->after('stadiumID')
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
		// Remove isOngoing attributes from fixture table
		Schema::table('fixture', function(Blueprint $table) {
			$table->dropColumn('isOngoing');
		});
	}

}