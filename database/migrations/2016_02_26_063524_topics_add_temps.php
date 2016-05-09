<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TopicsAddTemps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->text('topic_temp_authors')->nullable();
            $table->text('topic_temp_authors2')->nullable();
            $table->text('topic_temp_authors3')->nullable();
            $table->text('topic_temp_authors4')->nullable();
            $table->text('topic_temp_publication_date')->nullable();
            $table->text('topic_temp_pages')->nullable();
            $table->text('topic_temp_publisher')->nullable();
            $table->text('topic_temp_publisher2')->nullable();
            $table->text('topic_temp_publisher3')->nullable();
            $table->text('topic_temp_publisher4')->nullable();
            $table->text('topic_temp_license')->nullable();
            $table->text('topic_temp_license2')->nullable();
            $table->text('topic_temp_license3')->nullable();
            $table->text('topic_temp_license4')->nullable();
            $table->text('topic_temp_post_text')->nullable();
            $table->text('topic_temp_ISBN')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('topic_temp_authors');
            $table->dropColumn('topic_temp_authors2');
            $table->dropColumn('topic_temp_authors3');
            $table->dropColumn('topic_temp_authors4');
            $table->dropColumn('topic_temp_publication_date');
            $table->dropColumn('topic_temp_pages');
            $table->dropColumn('topic_temp_publisher');
            $table->dropColumn('topic_temp_publisher2');
            $table->dropColumn('topic_temp_publisher3');
            $table->dropColumn('topic_temp_publisher4');
            $table->dropColumn('topic_temp_license');
            $table->dropColumn('topic_temp_license2');
            $table->dropColumn('topic_temp_license3');
            $table->dropColumn('topic_temp_license4');
            $table->dropColumn('topic_temp_post_text');
            $table->dropColumn('topic_temp_ISBN');
        });
    }
}
