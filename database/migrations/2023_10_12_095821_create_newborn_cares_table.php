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
        Schema::create('newborn_cares', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('body_weight');
            $table->integer('body_length');
            $table->integer('body_temperature');
            $table->string('breathing_frequency');
            $table->string('heart_rate_frequency');
            $table->string('check_possible_serious_illnesses');
            $table->string('check_jaundice');
            $table->string('check_diarrhea');
            $table->string('check_low_body_weight_and_problems_breastfeeding');
            $table->string('check_vit_k1_status');
            $table->string('check_hb_0_bcg_polio_1_immunization_status');
            $table->string('areas_that_have_implemented_Congenital_Hypothyroidism');
            $table->boolean('shk');
            $table->string('shk_test_result');
            $table->integer('visit_number');
            $table->string('visit_description');
            $table->foreignUuid('order_id')->constrained('orders')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newborn_cares');
    }
};
