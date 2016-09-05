<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conversation_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->integer('participant')->unsigned();
            $table->foreign('participant')->references('id')->on('participants')->onDelete('cascade');
            $table->string('body', 10000);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('messages');
    }
}
