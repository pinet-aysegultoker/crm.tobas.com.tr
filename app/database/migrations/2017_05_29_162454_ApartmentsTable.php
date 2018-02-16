<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('apartments')) {
            Schema::create('apartments', function ($table) {
                $table->increments('id');
                $table->integer('building_id');
                $table->integer('creator_id');
                $table->string('lot', 15);
                $table->string('bb_code', 15);
                $table->string('title', 63);
                $table->string('floor', 63);
                $table->string('number', 63);
                $table->decimal('net_area', 8, 2);
                $table->decimal('gross_area', 8, 2);
                $table->enum('type', array('apartment', 'duplex', 'triplex', 'villa', 'office'));
                $table->enum('room', array('1+1', '2+1', '3+1', '4+1', '5+1', '6+1', '7+1'));
                $table->enum('front', array('K', 'G', 'D', 'B', 'KD', 'KB', 'GD', 'GB'));
                $table->enum('front_view', array('none', 'building', 'retaining', 'open', 'scenic', 'garden', 'project'));
                $table->enum('back_view', array('none', 'building', 'retaining', 'open', 'scenic', 'garden', 'project'));
                $table->mediumText('details');
                $table->decimal('price', 12, 2);
                $table->enum('status', array('active', 'passive', 'reserved', 'removed'));
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
        Schema::dropIfExists('apartments');
	}

}
