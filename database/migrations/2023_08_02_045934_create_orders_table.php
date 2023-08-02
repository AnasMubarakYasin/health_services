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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->enum('status', ['ready', 'not ready']);
            $table->dateTime('schedule');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->foreignUuid('patient_id')->constrained('patients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('service_id')->constrained('services')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};