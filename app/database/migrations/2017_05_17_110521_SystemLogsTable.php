<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('system_logs')) {
            Schema::create('system_logs', function ($table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('user_ip', 15);
                $table->string('route', 255)->nullable();
                $table->enum('type', array('auth', 'create', 'show', 'edit', 'remove'));
                $table->integer('data_id')->nullable();
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
        Schema::dropIfExists('system_logs');
	}

}
