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
        Schema::create('product_assessment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id')->nullable();
            $table->uuid('user_id');
            $table->uuid('product_id');
            $table->integer('rating')->nullable();
            $table->fullText('content')->nullable();
            $table->string('response_operator') ->nullable();
            $table->timestamps();
            $table->foreign('order_id')
            ->references('id')->on('order')->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')->on('user')->onDelete('cascade');
            $table->foreign('product_id')
            ->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_assessment');
    }
};
