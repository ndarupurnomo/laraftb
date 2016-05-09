<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TopicsAddLicenseEtc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('license_id')->nullable();
            $table->integer('topic_active_time')->default(0);
            $table->smallInteger('topic_active')->unsigned()->default(1);
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
            $table->dropColumn('topic_active');
            $table->dropColumn('topic_active_time');
            $table->dropColumn('license_id');
        });
    }
}
