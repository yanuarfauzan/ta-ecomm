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
        Schema::create('shipping', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('shipping_provider_id');
            $table->enum('shipping_type', ['standart', 'express'])->nullable();
            $table->enum('shipping_status', ['proccess', 'sent', 'received'])->nullable();
            $table->string('resi_number')->nullable();
            $table->string('shipping_address')->nullable();
            $table->integer('shipping_cost')->unsigned();
            $table->timestamps();
            $table->foreign('shipping_provider_id')->references('id')->on('shipping_provider')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping');
    }
};
