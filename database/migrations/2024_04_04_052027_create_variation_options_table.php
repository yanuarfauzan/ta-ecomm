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
        Schema::create('variation_option', function (Blueprint $table) {
            $table->id();
            $table->uuid('variation_id');
            $table->uuid('product_image_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('price')->nullable()->default(0);
            $table->decimal('weight')->nullable();
            $table->string('dimensions')->nullable();
            $table->timestamps();
            $table->foreign('variation_id')
            ->references('id')->on('variation')->onDelete('cascade');
            $table->foreign('product_image_id')
            ->references('id')->on('product_image')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_option');
    }
};
