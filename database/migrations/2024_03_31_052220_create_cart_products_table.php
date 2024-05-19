<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->uuid('cart_id');
            $table->uuid('order_id')->nullable();
            $table->boolean('is_locked')->nullable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_product');
    }
};
