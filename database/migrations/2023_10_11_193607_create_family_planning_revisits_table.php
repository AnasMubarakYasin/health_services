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
        Schema::create('family_planning_revisits', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->date('revisit_date');
            $table->string('description');
            $table->foreignUuid('family_plannig_id')->constrained('family_plannigs')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_planning_revisits');
    }
};
