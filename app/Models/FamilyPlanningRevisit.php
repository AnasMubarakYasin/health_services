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

class FamilyPlanningRevisit extends Model
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
            'revisit_date' => new Definition(
                name: 'revisit_date',
                type: 'date',
            ),
            'description' => new Definition(
                name: 'description',
                type: 'string',
            ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $attributes = [];
    protected $fillable = [
        'revisit_date',
        'description',
    ];

    public function family_planning()
    {
        return $this->belongsTo(FamilyPlanning::class, 'family_planning_id');
    }
}
