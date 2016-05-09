<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('short_description');
            $table->text('long_description');
            $table->string('ISBN10', 10)->nullable();
            $table->string('ISBN13', 13)->nullable();
            $table->integer('pages')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('download_url');
            $table->string('webpage_url')->nullable();
            $table->integer('publisher_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
