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
        Schema::create('product_voucher', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id')->nullable();
            $table->uuid('voucher_id')->nullable();
            $table->timestamps();
            $table->foreign('product_id')
            ->references('id')->on('product')->onDelete('cascade');
            $table->foreign('voucher_id')
            ->references('id')->on('voucher')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void    {
        Schema::dropIfExists('product_voucher');
    }
};
