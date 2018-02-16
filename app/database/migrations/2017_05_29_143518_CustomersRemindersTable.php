<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomersRemindersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('customers_reminders')) {
            Schema::create('customers_reminders', function ($table) {
                $table->increments('id');
                $table->integer('customer_id');
                $table->integer('creator_id');
                $table->string('description', 2047);
                $table->dateTime('time');
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
        Schema::dropIfExists('customers_reminders');
	}

}
