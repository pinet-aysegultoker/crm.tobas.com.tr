<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomersDetailsTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('customers_details_types')) {
            Schema::create('customers_details_types', function ($table) {
                $table->increments('id');
                $table->integer('title');
                $table->enum('type', array('text', 'select', 'option', 'image', 'file'));
                $table->string('type_array', 2047)->nullable();
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
        Schema::dropIfExists('customers_details_types');
	}

}
