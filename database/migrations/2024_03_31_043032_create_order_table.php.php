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
        Schema::create('order', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('shipping_id')->nullable();
            $table->string('order_number')->nullable();
            $table->date('order_date')->nullable();
            $table->integer('total_price')->nullable();
            $table->enum('order_status', ['pending', 'awaiting payment', 'awaiting fulfillment', 'awaiting shipment', 'shipped', 'delivered', 'cancelled', 'refunded', 'completed'])->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->foreign('shipping_id')->references('id')->on('shipping')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
