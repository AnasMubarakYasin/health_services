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

class FamilyPlanning extends Model
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
            'participant_name' => new Definition(
                name: 'participant name',
                type: 'string',
            ),
            'husband_or_wife_name' => new Definition(
                name: 'husband or wife name',
                type: 'string',
            ),
            'birthday_or_age_wife' => new Definition(
                name: 'birthday or age wife',
                type: 'string',
            ),
            'participant_address' => new Definition(
                name: 'participant address',
                type: 'string',
            ),
            'tool_or_medicine_or_treatment_method' => new Definition(
                name: 'tool or medicine or treatment method',
                type: 'string',
            ),
            'attach_date' => new Definition(
                name: 'attach date',
                type: 'date',
            ),
            'detach_date' => new Definition(
                name: 'detach date',
                type: 'date',
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
        'participant_name',
        'husband_or_wife_name',
        'birthday_or_age_wife',
        'participant_address',
        'tool_or_medicine_or_treatment_method',
        'attach_date',
        'detach_date',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
