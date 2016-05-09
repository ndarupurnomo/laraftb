<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TopicAddReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->integer('license_id')->unsigned()->nullable()->default(null)->change();
            $table->integer('publisher_id')->unsigned()->nullable()->default(null)->change();
            $table->foreign('license_id')->references('license_id')->on('licenses');
            $table->foreign('publisher_id')->references('publisher_id')->on('publishers');
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
            $table->dropForeign(['license_id']);
            $table->dropForeign(['publisher_id']);
            $table->integer('license_id')->unsigned()->nullable()->default(null)->change();
            $table->integer('publisher_id')->unsigned()->nullable()->default(null)->change();
        });
    }
}
