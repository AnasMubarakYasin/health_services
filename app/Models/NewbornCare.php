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

class NewbornCare extends Model
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
            'body_weight' => new Definition(
                name: 'body weight',
                type: 'number',
            ),
            'body_length' => new Definition(
                name: 'body length',
                type: 'number',
            ),
            'body_temperature' => new Definition(
                name: 'body temperature',
                type: 'number',
            ),
            'breathing_frequency' => new Definition(
                name: 'breathing frequency',
                type: 'string',
            ),
            'heart_rate_frequency' => new Definition(
                name: 'heart rate frequency',
                type: 'string',
            ),
            'check_possible_serious_illnesses' => new Definition(
                name: 'check possible serious illnesses',
                type: 'string',
            ),
            'check_jaundice' => new Definition(
                name: 'check jaundice',
                type: 'string',
            ),
            'check_diarrhea' => new Definition(
                name: 'check diarrhea',
                type: 'string',
            ),
            'check_low_body_weight_and_problems_breastfeeding' => new Definition(
                name: 'check low body weight and problems breastfeeding',
                type: 'string',
            ),
            'check_vit_k1_status' => new Definition(
                name: 'check vit k1 status',
                type: 'string',
            ),
            'check_hb_0_bcg_polio_1_immunization_status' => new Definition(
                name: 'check hb 0 bcg polio 1 immunization status',
                type: 'string',
            ),
            'areas_that_have_implemented_Congenital_Hypothyroidism' => new Definition(
                name: 'areas that have implemented congenital hypothyroidism',
                type: 'string',
            ),
            'shk' => new Definition(
                name: 'shk',
                type: 'boolean',
                default: false,
            ),
            'shk_test_result' => new Definition(
                name: 'shk test result',
                type: 'string',
            ),
            'visit_number' => new Definition(
                name: 'visit number',
                type: 'string',
            ),
            'visit_description' => new Definition(
                name: 'visit description',
                type: 'string',
            ),
            // 'crated_at' => new Definition(
            //     name: 'visit date',
            //     type: 'date',
            // ),
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
        'body_weight',
        'body_length',
        'body_temperature',
        'breathing_frequency',
        'heart_rate_frequency',
        'check_possible_serious_illnesses',
        'check_jaundice',
        'check_diarrhea',
        'check_low_body_weight_and_problems_breastfeeding',
        'check_vit_k1_status',
        'check_hb_0_bcg_polio_1_immunization_status',
        'areas_that_have_implemented_Congenital_Hypothyroidism',
        'shk',
        'shk_test_result',
        'visit_number',
        'visit_description',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
