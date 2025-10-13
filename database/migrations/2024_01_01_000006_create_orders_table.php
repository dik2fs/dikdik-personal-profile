<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->text('customer_address')->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('quantity')->default(1);
            $table->enum('status', ['pending', 'confirmed', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->enum('type', ['ebook', 'physical'])->default('ebook');
            $table->text('notes')->nullable();
            $table->string('payment_method')->default('whatsapp');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};