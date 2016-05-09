<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PublishersAddSlugEtc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publishers', function (Blueprint $table) {
            $table->string('slug');
            $table->string('publisher_url');
            $table->index(['slug']);
            $table->index(['slug', 'publisher_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publishers', function (Blueprint $table) {
            $table->dropIndex(['slug', 'publisher_id']);
            $table->dropIndex(['slug']);
            $table->dropColumn('publisher_url');
            $table->dropColumn('slug');
        });
    }
}
