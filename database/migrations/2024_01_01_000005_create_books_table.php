<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->text('description');
            $table->string('isbn')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->string('cover_image')->nullable();
            $table->string('book_file')->nullable(); // Untuk ebook
            $table->json('categories');
            $table->integer('pages')->nullable();
            $table->string('publisher')->nullable();
            $table->date('published_date')->nullable();
            $table->string('language')->default('Indonesia');
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_ebook')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};