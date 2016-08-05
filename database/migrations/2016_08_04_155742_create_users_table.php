<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamps('created');
            $table->string('password');
            $table->timestamp('password_change');
            $table->text('prename');
            $table->text('lastname');
            $table->text('username');
            $table->integer('status')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->rememberToken();
            $table->string('picture');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
