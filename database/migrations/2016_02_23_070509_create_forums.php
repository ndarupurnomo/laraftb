<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->increments('forum_id');
            $table->integer('cat_id')->unsigned()->default(0);
            $table->string('forum_name', 150)->nullable();
            $table->text('forum_desc')->nullable();
            $table->mediumInteger('forum_order')->unsigned()->default(1);
            $table->enum('forum_sort', ['DATE', 'ASC', 'DESC'])->default('DATE');
            $table->timestamps();
            //
            $table->index('forum_order');
            $table->index('cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forums');
    }
}
