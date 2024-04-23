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
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('SKU')->nullable();
            $table->integer('stock')->nullable();
            $table->string('product_image')->nullable();
            $table->integer('price')->nullable();
            $table->string('desc')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('dimensions')->nullable();
            $table->integer('rate', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
