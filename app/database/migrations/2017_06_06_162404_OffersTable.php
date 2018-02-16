<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('offers')) {
            Schema::create('offers', function ($table) {
                $table->increments('id');
                $table->integer('apartment_id');
                $table->integer('customer_id');
                $table->integer('creator_id');
                $table->string('subject', 255);
                $table->string('description', 2047);
                $table->date('start_date');
                $table->date('finish_date');
                $table->decimal('price', 12, 2);
                $table->decimal('discount', 12, 2);
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
        Schema::dropIfExists('offers');
	}

}
