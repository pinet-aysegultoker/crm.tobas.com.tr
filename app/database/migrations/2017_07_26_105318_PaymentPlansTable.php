<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('payment_plans')) {
            Schema::create('payment_plans', function ($table) {
                $table->increments('id');
                $table->integer('apartment_id');
                $table->integer('customer_id')->nullable();
                $table->integer('creator_id');
                $table->decimal('price', 12, 2);
                $table->decimal('discount', 12, 2);
                $table->integer('advance');
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
        Schema::dropIfExists('payment_plans');
	}

}
