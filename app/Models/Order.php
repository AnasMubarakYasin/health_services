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

class Order extends Model
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;
    use Tableable, Formable, Statable;

    public static function modelable(): Model
    {
        return new self();
    }
    public static function defining()
    {
        self::$caption = "order";
        self::$definitions = [
            'status' => new Definition(
                name: 'status',
                type: 'enum',
                enums: [
                    'ready', 'not ready'
                ]
            ),
            'schedule' => new Definition(
                name: 'schedule',
                type: 'string',
            ),
            'start_at' => new Definition(
                name: 'start at',
                type: 'date',
                format: 'Y-m-d',
            ),
            'end_at' => new Definition(
                name: 'end at',
                type: 'date',
                format: 'Y-m-d',
            ),
            'patient' => new Definition(
                name: 'patient',
                type: 'model',
                array: false,
                relation: 'patient',
                alias: 'patient_id',
            ),
            'service' => new Definition(
                name: 'service',
                type: 'model',
                array: false,
                relation: 'service',
                alias: 'service_id',
            ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $fillable = [
        'status', 'schedule', 'start_at', 'end_at', 'patient_id', 'service_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function service()
    {
        return $this->belongsTo(Patient::class, 'service_id');
    }

    public function visits()
    {
        return visits($this);
    }
}
