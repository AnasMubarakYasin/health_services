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
        Schema::table("orders", function (Blueprint $table) {
            // $table->enum('status', ['auto_finish', 'finished', 'on_progress', 'scheduled'])->change();
            $table->enum("confirm", ["no", "yes"])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("orders", function (Blueprint $table) {
            // $table->enum('status', ['finished', 'on_progress', 'scheduled'])->change();
            $table->dropColumn("confirm");
        });
    }
};
