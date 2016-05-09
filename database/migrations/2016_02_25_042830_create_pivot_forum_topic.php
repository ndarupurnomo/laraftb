<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotForumTopic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topic', function (Blueprint $table) {
            $table->integer('forum_id')->unsigned()->index();
            $table->foreign('forum_id')->references('forum_id')->on('forums')->onDelete('cascade');
            $table->integer('topic_id')->unsigned()->index();
            $table->foreign('topic_id')->references('topic_id')->on('topics')->onDelete('cascade');
            $table->timestamps();
            //
            $table->primary(['forum_id', 'topic_id']);
            // $table->index('forum_id');
            // $table->index('topic_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_topic');
    }
}
