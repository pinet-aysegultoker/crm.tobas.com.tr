<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MeetingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('meetings')) {
            Schema::create('meetings', function ($table) {
                $table->increments('id');
                $table->integer('customer_id');
                $table->integer('creator_id');
                $table->integer('updater_id')->nullable();
                $table->enum('status', array('started', 'updated', 'finished', 'removed'));
                $table->timestamps();
            });
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('meetings');
	}

}
