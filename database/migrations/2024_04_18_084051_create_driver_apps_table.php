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
        Schema::create('driver_apps', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['owner', 'company'])->default('company');
            $table->foreignId('driver_id')->references('id')->on('drivers')->cascadeOnDelete();
            $table->unsignedBigInteger('operator_id')->nullable();
            $table->foreign('operator_id')->references('id')->on('operators')->cascadeOnDelete();
            $table->enum('status', ['available', 'not available'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_apps');
    }
};
