<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthorsRenameId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            // $table->dropIndex(['slug', 'id']);
            // $table->dropPrimary(['id']);
            $table->renameColumn('id', 'author_id');
            // $table->primary(['author_id']);
            // $table->index(['slug', 'author_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authors', function (Blueprint $table) {
            // $table->dropIndex(['slug', 'author_id']);
            // $table->dropPrimary(['author_id']);
            $table->renameColumn('author_id','id');
            // $table->primary(['id']);
            // $table->index(['slug', 'id']);
        });
    }
}
