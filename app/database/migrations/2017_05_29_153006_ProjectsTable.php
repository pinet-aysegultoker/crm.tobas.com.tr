<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('projects')) {
            Schema::create('projects', function ($table) {
                $table->increments('id');
                $table->integer('creator_id');
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
        Schema::dropIfExists('projects');
	}

}
