<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created');
            $table->integer('user_id')->unsigned();
            $table->integer('feed_id')->unsigned();
            $table->string('content', 5000);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('feed_id')->references('id')->on('feed')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feed_comment');
    }
}
