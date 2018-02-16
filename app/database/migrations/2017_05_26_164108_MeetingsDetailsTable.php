<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MeetingsDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('meetings_details')) {
            Schema::create('meetings_details', function ($table) {
                $table->increments('id');
                $table->integer('meeting_id');
                $table->integer('creator_id');
                $table->mediumText('details');
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
        Schema::dropIfExists('meetings_details');
	}

}
