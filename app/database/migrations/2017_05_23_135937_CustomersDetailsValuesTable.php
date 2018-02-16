<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomersDetailsValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('customers_details_values')) {
            Schema::create('customers_details_values', function ($table) {
                $table->increments('id');
                $table->integer('customer_id');
                $table->integer('type_id');
                $table->string('value', 1023);
                $table->integer('creator_id');
                $table->integer('updater_id');
                $table->enum('status', array('active', 'passive', 'removed'));
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
        Schema::dropIfExists('customers_details_values');
	}

}
