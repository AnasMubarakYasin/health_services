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
        Schema::create('order_limits', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('limit');
            $table->date('date');

            $table->foreignUuid('midwife_id')->constrained('midwives')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_limits');
    }
};
