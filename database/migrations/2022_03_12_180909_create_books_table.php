<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->bigInteger('author_id')->unsigned();
            $table->foreign('author_id')
                  ->references('id')
                  ->on('authors')
                  ->onDelete('cascade');
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
                ->onDelete('cascade');
            $table->integer('year')->length(4)->unsigned()->nullable();
            $table->string('description',2000);
            $table->string('img');
            $table->integer('hide')->default(0);
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
        Schema::dropIfExists('books');
    }
};
