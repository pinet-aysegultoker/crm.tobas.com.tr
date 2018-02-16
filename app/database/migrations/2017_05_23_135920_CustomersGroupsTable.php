<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomersGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('customers_groups')) {
            Schema::create('customers_groups', function ($table) {
                $table->increments('id');
                $table->integer('parent_group_id')->nullable();
                $table->string('title', 63);
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
        Schema::dropIfExists('customers_groups');
	}

}
