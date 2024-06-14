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
            $table->uuid('user_id')->nullable();
            $table->uuid('product_id')->nullable();
            $table->uuid('address_id')->nullable();
            $table->string('order_number')->nullable();
            $table->date('order_date')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('total_price')->nullable();
            $table->enum('order_status', 
            ['unpaid',
            'pending',
            'paid',
            'failed',
            'proceed',
            'shipped',
            'delivered',
            'cancelled',
            'completed'
            ])->default('unpaid')->nullable();
            $table->string('note')->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamps();
            $table->foreign('shipping_id')
            ->references('id')->on('shipping')->onDelete('cascade');
            $table->foreign('address_id')
            ->references('id')->on('address')->onDelete('cascade');
            $table->foreign('product_id')
            ->references('id')->on('product')->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')->on('user')->onDelete('cascade');
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
