<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id')->unique();
			$table->enum('method', ['GET', 'POST']);
			$table->string('path');
			$table->string('parameters');
			$table->enum('engine', ['retrofit', 'volley', 'ion', 'robospice']);
			$table->timestamp('start_time');
			$table->timestamp('end_time');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requests');
	}

}
