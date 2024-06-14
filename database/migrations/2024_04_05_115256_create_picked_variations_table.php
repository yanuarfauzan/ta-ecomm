<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('picked_variation', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->uuid('variation_id');
            $table->uuid('cart_id')->nullable()->default(null);
            $table->uuid('order_id')->nullable();
            $table->unsignedBigInteger('variation_option_id');
            $table->timestamps();
            $table->foreign('product_id')
            ->references('id')->on('product')->onDelete('cascade');
            $table->foreign('cart_id')
            ->references('id')->on('cart')->onDelete('cascade');
            $table->foreign('order_id')
            ->references('id')->on('order')->onDelete('cascade');
            $table->foreign('variation_id')
            ->references('id')->on('variation')->onDelete('cascade');
            $table->foreign('variation_option_id')
            ->references('id')->on('variation_option')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picked_variation');
    }
};
