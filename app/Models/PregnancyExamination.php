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

class PregnancyExamination extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    use Tableable, Formable, Statable;

    public static function modelable(): Model
    {
        return new self();
    }
    public static function defining()
    {
        self::$caption = "pregnancy examination";
        self::$definitions = [
            'first_day_of_last_mesntruation' => new Definition(
                name: 'first day of last mesntruation',
                type: 'date',
            ),
            'estimated_day_of_birth' => new Definition(
                name: 'estimated day of birth',
                type: 'date',
            ),
            'upper_arm_circle' => new Definition(
                name: 'upper arm circle',
                type: 'number',
            ),
            'kek' => new Definition(
                name: 'kek',
                type: 'boolean',
                default: false,
                nullable: true,
            ),
            'height' => new Definition(
                name: 'height',
                type: 'number',
            ),
            'blood_group' => new Definition(
                name: 'blood group',
                type: 'enum',
                enums: [
                    'o-' => 'O-',
                    'o+' => 'O+',
                    'a-' => 'A-',
                    'a+' => 'A+',
                    'b-' => 'B-',
                    'b+' => 'B+',
                    'ab-' => 'AB-',
                    'ab+' => 'AB+',
                ],
            ),
            'use_of_contraception_before_pregnancy' => new Definition(
                name: 'use of contraception before pregnancy',
                type: 'string',
                nullable: true,
            ),
            'history_of_illness_suffered_by_the_mother' => new Definition(
                name: 'history of illness suffered by the mother',
                type: 'string',
                nullable: true,
            ),
            'history_of_allergies' => new Definition(
                name: 'history of allergies',
                type: 'string',
                nullable: true,
            ),
            'number_of_pregnancies' => new Definition(
                name: 'number of pregnancies',
                type: 'number',
            ),
            'number_of_births' => new Definition(
                name: 'number of births',
                type: 'number',
            ),
            'number_of_miscarriages' => new Definition(
                name: 'number of miscarriages',
                type: 'number',
            ),
            'number_of_living_children' => new Definition(
                name: 'number of living children',
                type: 'number',
                nullable: true,
            ),
            'number_of_stillbirths' => new Definition(
                name: 'number of stillbirths',
                type: 'number',
                nullable: true,
            ),
            'number_of_children_born_preterm' => new Definition(
                name: 'number of children born preterm',
                type: 'number',
                nullable: true,
            ),
            'the_distance_between_this_pregnancy_and_the_last_delivery' => new Definition(
                name: 'the distance between this pregnancy and the last delivery',
                type: 'string',
            ),
            'latest_tt_immunization_status' => new Definition(
                name: 'latest tt immunization status',
                type: 'string',
                nullable: true,
            ),
            'last_helper_in_childbirth' => new Definition(
                name: 'last helper in childbirth',
                type: 'string',
            ),
            'last_method_of_delivery' => new Definition(
                name: 'last method of delivery',
                type: 'enum',
                enums: [
                    'normal' => 'normal',
                    'action' => 'action',
                ]
            ),
            'last_method_of_delivery_action' => new Definition(
                name: 'last method of delivery action',
                type: 'string',
                nullable: true,
            ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $attributes = [
        'kek' => false,
        'use_of_contraception_before_pregnancy' => '',
        'history_of_illness_suffered_by_the_mother' => '',
        'history_of_allergies' => '',
        // 'number_of_pregnancies' => 1,
        // 'number_of_miscarriages' => 0,
        // 'number_of_stillbirths' => 0,
    ];
    protected $fillable = [
        'first_day_of_last_mesntruation',
        'estimated_day_of_birth',
        'upper_arm_circle',
        'kek',
        'height',
        'blood_group',
        'use_of_contraception_before_pregnancy',
        'history_of_illness_suffered_by_the_mother',
        'history_of_allergies',
        'number_of_pregnancies',
        'number_of_births',
        'number_of_miscarriages',
        'number_of_living_children',
        'number_of_stillbirths',
        'number_of_children_born_preterm',
        'the_distance_between_this_pregnancy_and_the_last_delivery',
        'latest_tt_immunization_status',
        'last_helper_in_childbirth',
        'last_method_of_delivery',
        'last_method_of_delivery_action',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
