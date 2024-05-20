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
        Schema::create('provincies_and_cities', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->string('province')->nullable();
            $table->string('type')->nullable();
            $table->string('city_name')->nullable();
            $table->integer('postal_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provincies_and_cities');
    }
};
