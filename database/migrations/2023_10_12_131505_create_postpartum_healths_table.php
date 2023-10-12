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
        Schema::create('postpartum_healths', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->string("general_condition_of_the_mother");
            $table->string("blood_pressure_body_temperature_respiration_pulse");
            $table->string("vaginal_bleeding");
            $table->string("perineal_conditions");
            $table->string("signs_of_infection");
            $table->string("fundus_uteri_height");
            $table->string("lochia");
            $table->string("birth_canal_examination");
            $table->string("breast_examination");
            $table->string("lactation");
            $table->string("give_capsules_vit_a");
            $table->string("postpartum_contraceptive_services");
            $table->string("high_risk_treatment_and_complications_in_postpartum");
            $table->integer('visit_number');
            $table->string('visit_description');
            $table->string("visit_note");
            $table->foreignUuid('order_id')->constrained('orders')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postpartum_healths');
    }
};
