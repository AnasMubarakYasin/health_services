<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Dynamic\Resource\Definition;
use App\Dynamic\Trait\Formable;
use App\Dynamic\Trait\Statable;
use App\Dynamic\Trait\Tableable;

class PostpartumHealth extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    use Tableable, Formable, Statable;

    public static function modelable(): Model
    {
        return new self();
    }
    public static function defining()
    {
        self::$caption = "";
        self::$definitions = [
            "general_condition_of_the_mother" => new Definition(
                name: 'general condition of the mother',
                type: 'string',
            ),
            "blood_pressure_body_temperature_respiration_pulse" => new Definition(
                name: 'blood pressure body temperature respiration pulse',
                type: 'string',
            ),
            "vaginal_bleeding" => new Definition(
                name: 'vaginal bleeding',
                type: 'string',
            ),
            "perineal_conditions" => new Definition(
                name: 'perineal conditions',
                type: 'string',
            ),
            "signs_of_infection" => new Definition(
                name: 'signs of infection',
                type: 'string',
            ),
            "fundus_uteri_height" => new Definition(
                name: 'fundus uteri height',
                type: 'string',
            ),
            "lochia" => new Definition(
                name: 'lochia',
                type: 'string',
            ),
            "birth_canal_examination" => new Definition(
                name: 'birth canal examination',
                type: 'string',
            ),
            "breast_examination" => new Definition(
                name: 'breast examination',
                type: 'string',
            ),
            "lactation" => new Definition(
                name: 'lactation',
                type: 'string',
            ),
            "give_capsules_vit_a" => new Definition(
                name: 'give capsules vit a',
                type: 'string',
            ),
            "postpartum_contraceptive_services" => new Definition(
                name: 'postpartum contraceptive services',
                type: 'string',
            ),
            "high_risk_treatment_and_complications_in_postpartum" => new Definition(
                name: 'high risk treatment and complications in postpartum',
                type: 'string',
            ),
            // 'visit_string' => new Definition(
            //     name: 'visit string',
            //     type: 'string',
            // ),
            // 'visit_description' => new Definition(
            //     name: 'visit description',
            //     type: 'string',
            // ),
            "visit_note" => new Definition(
                name: 'visit note',
                type: 'string',
            ),
            // 'order_id' => new Definition(
            //     name: 'order',
            //     type: 'stringe',
            // ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $attributes = [];
    protected $fillable = [
        "general_condition_of_the_mother",
        "blood_pressure_body_temperature_respiration_pulse",
        "vaginal_bleeding",
        "perineal_conditions",
        "signs_of_infection",
        "fundus_uteri_height",
        "lochia",
        "birth_canal_examination",
        "breast_examination",
        "lactation",
        "give_capsules_vit_a",
        "postpartum_contraceptive_services",
        "high_risk_treatment_and_complications_in_postpartum",
        'visit_number',
        'visit_description',
        "visit_note",
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
