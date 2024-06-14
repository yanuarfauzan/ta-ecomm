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
        Schema::create('product_category_variation', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->uuid('category_id')->nullable();
            $table->uuid('variation_id')->nullable();
            $table->timestamps();
            $table->foreign('product_id')
            ->references('id')->on('product')->onDelete('cascade');
            $table->foreign('category_id')
            ->references('id')->on('category')->onDelete('cascade');
            $table->foreign('variation_id')
            ->references('id')->on('variation')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category_variation');
    }
};
