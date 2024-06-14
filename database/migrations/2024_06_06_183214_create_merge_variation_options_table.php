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
        Schema::create('merge_variation_option', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->unsignedBigInteger('variation_option_1_id')->nullable();
            $table->unsignedBigInteger('variation_option_2_id')->nullable();
            $table->integer('merge_stock')->nullable();
            $table->integer('merge_price')->nullable();
            $table->integer('merge_price_after_discount')->nullable();
            $table->timestamps();
            $table->foreign('variation_option_1_id')
            ->references('id')->on('variation_option_id')->onDelete('cascade');
            $table->foreign('variation_option_2_id')
            ->references('id')->on('variation_option_id')->onDelete('cascade');
            $table->foreign('product_id')
            ->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merge_variation_option');
    }
};
