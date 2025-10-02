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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('license_key')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('brand_name');
            $table->string('phone');
            $table->string('os');
            $table->json('additional_data')->nullable();
            $table->enum('status', ['active', 'inactive', 'expired'])->default('inactive');
            $table->datetime('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
