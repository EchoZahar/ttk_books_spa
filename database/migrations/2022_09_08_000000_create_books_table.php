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
            $table->string('author', 150);
            $table->string('title', 150)->index();
            $table->mediumInteger('year'); // 4
            $table->text('description'); // 2000
            $table->text('cover')->nullable(); // 500
            $table->boolean('published')->default(false);
            $table->unsignedBigInteger('author_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author_id')->references('id')->on('authors')
                ->cascadeOnUpdate()->cascadeOnDelete();
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
