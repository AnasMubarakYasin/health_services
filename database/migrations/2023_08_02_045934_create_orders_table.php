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
            $table->enum('status', ['finished', 'on_progress', 'scheduled']);
            $table->date('schedule');
            $table->time('schedule_start');
            $table->time('schedule_end');
            $table->string('location_name');
            $table->json('location_coordinates');
            $table->text('complaint')->nullable();
            // $table->foreignUuid('pregnancy_examination_id')->nullable()->constrained('pregnancy_examinations')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->foreignUuid('note_nc_id')->nullable()->constrained('note_nc')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->foreignUuid('note_ph_id')->nullable()->constrained('note_ph')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->foreignUuid('note_fp_id')->nullable()->constrained('note_fp')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('patient_id')->constrained('patients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('midwife_id')->constrained('midwives')->cascadeOnUpdate()->cascadeOnDelete();
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
