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
            $table->string('provider_code')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('service')->nullable();
            $table->string('desc')->nullable();
            $table->integer('cost')->nullable();
            $table->string('etd')->nullable();
            $table->string('resi')->nullable();
            $table->timestamps();
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
