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
        Schema::create('midwives', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('fullname')->nullable();
            $table->string('telp')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midwives');
    }
};
