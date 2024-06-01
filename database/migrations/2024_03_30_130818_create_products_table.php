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
            $table->integer('price')->nullable();
            $table->decimal('weight')->nullable();
            $table->string('dimensions')->nullable();
            $table->integer('price_after_dsicount')->nullable();
            $table->string('desc', 1000)->nullable();
            $table->decimal('discount')->nullable();
            $table->integer('rate')->nullable();
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
