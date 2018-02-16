<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuildingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('buildings')) {
            Schema::create('buildings', function ($table) {
                $table->increments('id');
                $table->integer('project_id');
                $table->integer('creator_id');
                $table->string('island', 15);
                $table->string('parcel', 15);
                $table->string('title', 63);
                $table->mediumText('details');
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
        Schema::dropIfExists('buildings');
	}

}
