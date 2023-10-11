<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Dynamic\Resource\Definition;
use App\Dynamic\Trait\Formable;
use App\Dynamic\Trait\Statable;
use App\Dynamic\Trait\Tableable;

class PregnancyExaminationReport extends Model
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
            'created_at' => new Definition(
                name: 'date',
                type: 'date',
            ),
            'complaint' => new Definition(
                name: 'complaint',
                type: 'string',
            ),
            'blood_pressure' => new Definition(
                name: 'blood pressure',
                type: 'string',
            ),
            'weight' => new Definition(
                name: 'weight',
                type: 'number',
            ),
            'pregnancy_age' => new Definition(
                name: 'pregnancy age',
                type: 'number',
            ),
            'fundal_height' => new Definition(
                name: 'fundal height',
                type: 'number',
                nullable: true,
            ),
            'location_of_the_fetus' => new Definition(
                name: 'location of the fetus',
                type: 'string',
                nullable: true,
            ),
            'fetal_heart_rate' => new Definition(
                name: 'fetal heart rate',
                type: 'number',
                nullable: true,
            ),
            'swollen_foot' => new Definition(
                name: 'swollen foot',
                type: 'boolean',
                default: false,
                nullable: true,
            ),
            'laboratory_examination_results' => new Definition(
                name: 'laboratory examination results',
                type: 'string',
            ),
            'action' => new Definition(
                name: 'action',
                type: 'string',
            ),
            'advice' => new Definition(
                name: 'advice',
                type: 'string',
            ),
            'description' => new Definition(
                name: 'description',
                type: 'string',
            ),
            'when_to_return' => new Definition(
                name: 'when to return',
                type: 'string',
                nullable: true,
            ),
            // 'pregnancy_examination_id' => new Definition(
            //     name: 'pregnancy examination',
            //     type: 'string',
            // ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $attributes = [
        'complaint' => '',
        'blood_pressure' => '',
        // 'weight' => '',
        // 'pregnancy_age' => '',
        // 'fundal_height' => '',
        'location_of_the_fetus' => '',
        // 'fetal_heart_rate' => '',
        'swollen_foot' => false,
        'laboratory_examination_results' => '',
        'action' => '',
        'advice' => '',
        'description' => '',
        'when_to_return' => '',
    ];
    protected $fillable = [
        'complaint',
        'blood_pressure',
        'weight',
        'pregnancy_age',
        'fundal_height',
        'location_of_the_fetus',
        'fetal_heart_rate',
        'swollen_foot',
        'laboratory_examination_results',
        'action',
        'advice',
        'description',
        'when_to_return',
        'pregnancy_examination_id',
    ];

    public function pregnancy_examination()
    {
        return $this->belongsTo(PregnancyExamination::class, 'pregnancy_examination_id');
    }
}
