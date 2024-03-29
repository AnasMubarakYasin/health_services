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
            'active' => new Definition(
                name: 'active',
                type: 'boolean',
                default: true,
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

    public static function get_active()
    {
        return self::query()->where('active', true)->get();
    }
    public static function get_by_midwife(Midwife $midwife)
    {
        return self::query()->where('midwife_id', $midwife->id)->get();
    }

    protected $fillable = [
        'day',
        'started_at',
        'ended_at',
        'active',
        'midwife_id',
    ];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function midwife()
    {
        return $this->belongsTo(Midwife::class, 'midwife_id');
    }
}
