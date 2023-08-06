<?php

namespace App\Models;

use App\Dynamic\Resource\Definition;
use App\Dynamic\Trait\Formable;
use App\Dynamic\Trait\Statable;
use App\Dynamic\Trait\Tableable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Schedule extends Model
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;
    use Tableable, Formable, Statable;

    public static function modelable(): Model
    {
        return new self();
    }
    public static function defining()
    {
        self::$caption = "schedule";
        self::$definitions = [
            'day' => new Definition(
                name: 'day',
                type: 'enum',
                enums: [
                    'monday' => 'monday',
                    'tuesday' => 'tuesday',
                    'wednesday' => 'wednesday',
                    'thursday' => 'thursday',
                    'friday' => 'friday',
                    'saturday' => 'saturday',
                    'sunday' => 'sunday'
                ]
            ),
            'started_at' => new Definition(
                name: 'started at',
                type: 'time',
            ),
            'ended_at' => new Definition(
                name: 'ended at',
                type: 'time',
            ),
            'midwife' => new Definition(
                name: 'midwife',
                type: 'model',
                array: false,
                relation: 'midwife',
                alias: 'midwife_id',
            ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                'midwife' => Midwife::all(),
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $fillable = [
        'day', 'started_at', 'ended_at', 'midwife_id'
    ];

    public function midwife()
    {
        return $this->belongsTo(Midwife::class, 'midwife_id');
    }

    public function visits()
    {
        return visits($this);
    }
}
