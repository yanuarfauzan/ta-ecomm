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
        Schema::create('notif_user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->unsignedBigInteger('notification_id');
            $table->boolean('is_read')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')->on('user')->onDelete('cascade');
            $table->foreign('notification_id')
            ->references('id')->on('notification')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notif_user');
    }
};
