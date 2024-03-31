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
        Schema::create('user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone_number', 20)->nullable();
            $table->boolean('is_verified')->nullable()->default(false);
            $table->string('password')->nullable();
            $table->boolean('gender')->nullable();
            $table->date('birtdate')->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('role', ['user', 'operator', 'admin'])->nullable();
            $table->string('otp')->nullable();
            $table->string('token_reset')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};