<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('customers')) {
            Schema::create('customers', function ($table) {
                $table->increments('id');
                $table->integer('group_id');
                $table->integer('creator_id');
                $table->integer('updater_id')->nullable();
                $table->string('first_name', 63);
                $table->string('last_name', 63);
                $table->enum('status', array('active', 'passive', 'removed'));
                $table->dateTime('last_process_time')->nullable();
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
        Schema::dropIfExists('customers');
	}

}
