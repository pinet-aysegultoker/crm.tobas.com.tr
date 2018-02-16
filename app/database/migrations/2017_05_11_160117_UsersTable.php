<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('users')) {
            Schema::create('users', function ($table) {
                $table->increments('id');
                $table->integer('group_id');
                $table->integer('creator_id');
                $table->integer('updater_id');
                $table->string('username', 63);
                $table->string('email', 63);
                $table->string('first_name', 63);
                $table->string('last_name', 63);
                $table->string('password', 127);
                $table->string('remember_token', 127)->nullable();
                $table->enum('status', array('active', 'passive', 'removed'));
                $table->string('last_login_ip', 15)->nullable();
                $table->dateTime('last_login_time')->nullable();
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
        Schema::dropIfExists('users');
	}

}
