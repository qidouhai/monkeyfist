<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationTable extends Migration
{


    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title', 100)->nullable();
            $table->timestamp('last_message');
        });
    }

    public function down()
    {
        Schema::drop('conversations');
    }
}
