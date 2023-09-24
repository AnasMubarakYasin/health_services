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
        Schema::create('pregnancy_examinations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->date('first_day_of_last_mesntruation');
            $table->date('estimated_day_of_birth');
            $table->integer('upper_arm_circle');
            $table->boolean('kek')->default(false);
            $table->integer('height');
            $table->enum('blood_group', ['o-', 'o+', 'a-', 'a+', 'b-', 'b+', 'ab-', 'ab+']);
            $table->string('use_of_contraception_before_pregnancy')->nullable();
            $table->string('history_of_illness_suffered_by_the_mother')->nullable();
            $table->string('history_of_allergies')->nullable();
            $table->integer('number_of_pregnancies');
            $table->integer('number_of_births');
            $table->integer('number_of_miscarriages');
            $table->integer('number_of_living_children')->nullable();
            $table->integer('number_of_stillbirths')->nullable();
            $table->integer('number_of_children_born_preterm')->nullable();
            $table->string('the_distance_between_this_pregnancy_and_the_last_delivery');
            $table->string('latest_tt_immunization_status')->nullable();
            $table->string('last_helper_in_childbirth');
            $table->enum('last_method_of_delivery', ['normal', 'action']);
            $table->string('last_method_of_delivery_action')->nullable();
            $table->foreignUuid('order_id')->constrained('orders')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregnancy_examinations');
    }
};
