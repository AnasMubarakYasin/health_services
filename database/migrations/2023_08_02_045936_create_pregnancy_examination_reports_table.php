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
        Schema::create('pregnancy_examination_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->string('complaint')->nullable();
            $table->string('blood_pressure');
            $table->integer('weight');
            $table->integer('pregnancy_age');
            $table->integer('fundal_height')->nullable();
            $table->string('location_of_the_fetus')->nullable();
            $table->integer('fetal_heart_rate')->nullable();
            $table->boolean('swollen_foot')->default(false);
            $table->string('laboratory_examination_results');
            $table->string('action');
            $table->string('advice');
            $table->string('description');
            $table->string('when_to_return')->nullable();
            $table->foreignUuid('pregnancy_examination_id')->constrained('pregnancy_examinations')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregnancy_examination_reports');
    }
};
