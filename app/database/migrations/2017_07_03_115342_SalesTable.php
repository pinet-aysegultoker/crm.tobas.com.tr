<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('sales')) {
            Schema::create('sales', function ($table) {
                $table->increments('id');
                $table->integer('apartment_id');
                $table->integer('customer_id')->nullable();
                $table->integer('offer_id')->nullable();
                $table->integer('creator_id');
                $table->string('description', 2047);
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
        Schema::dropIfExists('sales');
	}

}
