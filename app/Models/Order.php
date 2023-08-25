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
use Illuminate\Support\Facades\DB;
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
                    'finished' => 'finished',
                    'on_progress' => 'on progress',
                    'scheduled' => 'scheduled',
                ]
            ),
            'schedule' => new Definition(
                name: 'schedule',
                type: 'date',
            ),
            'schedule_start' => new Definition(
                name: 'schedule start',
                type: 'time',
            ),
            'schedule_end' => new Definition(
                name: 'schedule end',
                type: 'time',
            ),
            'location_name' => new Definition(
                name: 'location name',
                type: 'string',
            ),
            'location_coordinates' => new Definition(
                name: 'location coordinates',
                type: 'string',
            ),
            'complaint' => new Definition(
                name: 'complaint',
                type: 'string',
                format: 'area',
                nullable: true,
            ),
            'patient' => new Definition(
                name: 'patient',
                type: 'model',
                array: false,
                relation: 'patient',
                alias: 'patient_id',
            ),
            'midwife' => new Definition(
                name: 'midwife',
                type: 'model',
                array: false,
                relation: 'midwife',
                alias: 'midwife_id',
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
                'patient' => Patient::all(),
                'midwife' => Midwife::all(),
                'service' => Service::all(),
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }
    public static function first_unfinish_by_patient(Patient $patient)
    {
        return self::query()
            ->where('patient_id', $patient->id)
            ->whereNot('status', 'finished')
            ->first();
    }
    public static function get_by_patient(Patient $patient)
    {
        return self::query()->where('patient_id', $patient->id)->get();
    }
    public static function get_by_midwife(Midwife $midwife)
    {
        return self::query()->where('midwife_id', $midwife->id)->get();
    }
    public static function get_unfinish()
    {
        return self::query()
            ->whereNot('status', 'finished')
            ->get();
    }
    public static function get_unfinish_by_midwife(Midwife $midwife)
    {
        return self::query()
            ->where('midwife_id', $midwife->id)
            ->whereNot('status', 'finished')
            ->get();
    }

    protected $fillable = [
        'status',
        'schedule',
        'schedule_start',
        'schedule_end',
        'location_name',
        'location_coordinates',
        'complaint',
        'patient_id',
        'midwife_id',
        'service_id',
    ];
    protected $casts = [
        'location_coordinates' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function midwife()
    {
        return $this->belongsTo(Midwife::class, 'midwife_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
