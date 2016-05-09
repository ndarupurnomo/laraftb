<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('topic_id');
            // $table->integer('forum_id')->unsigned()->default(0); // many-to-many relationship, needs pivot table
            // $table->integer('author_id')->unsigned()->default(0); // many-to-many relationship, needs pivot table
            $table->string('topic_title')->default('');
            $table->integer('poster_id')->unsigned()->default(0); // many-to-one relationship with users->id
            $table->integer('topic_time')->default(0);
            $table->mediumInteger('topic_views')->unsigned()->default(0);
            $table->string('topic_description')->default('');
            $table->integer('topic_post_edit_time')->nullable();
            $table->smallInteger('topic_post_edit_count')->unsigned()->default(0);
            $table->string('topic_bbcode_uid', 10)->nullable();
            $table->text('topic_post_text');
            $table->timestamps();
            //
            $table->string('topic_cover')->nullable();
            $table->string('topic_ISBN10', 10)->nullable();
            $table->string('topic_ISBN13', 13)->nullable();
            $table->smallInteger('topic_pages')->unsigned()->nullable();
            $table->integer('publisher_id')->unsigned()->default(0); // many-to-one relationship with publishers->publisher_id
            $table->date('topic_publication_date')->nullable();
            $table->string('topic_download_url');
            $table->string('topic_webpage_url')->nullable();
            //
            $table->index('publisher_id');
            $table->index('poster_id');
            $table->index('topic_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topics');
    }
}
