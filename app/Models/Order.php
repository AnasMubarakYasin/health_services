<?php

namespace App\Models;

use App\Dynamic\Resource\Definition;
use App\Dynamic\Trait\Formable;
use App\Dynamic\Trait\Statable;
use App\Dynamic\Trait\Tableable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
            'confirm' => new Definition(
                name: 'confirm',
                type: 'enum',
                enums: [
                    'no' => 'no',
                    'yes' => 'yes',
                ],
                nullable: true,
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
            'rating' => new Definition(
                name: 'rating',
                type: 'number',
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
            // 'pregnancy_examination' => new Definition(
            //     name: 'pregnancy examination',
            //     type: 'model',
            //     array: false,
            //     relation: 'pregnancy_examination',
            //     alias: 'pregnancy_examination_id',
            // ),
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
    // public static function first_unfinish_by_patient(Patient $patient)
    // {
    //     return self::query()
    //         ->where('patient_id', $patient->id)
    //         ->whereNot('status', 'finished')
    //         ->first();
    // }
    public static function get_unfinish_by_patient(Patient $patient)
    {
        return self::query()
            ->where('patient_id', $patient->id)
            // ->whereNot('status', 'finished')
            ->where('confirm', null)
            ->get();
    }
    public static function count_unfinish_by_patient(Patient $patient)
    {
        return self::query()
            ->where('patient_id', $patient->id)
            // ->whereNot('status', 'finished')
            ->where('confirm', null)
            ->count();
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
    public static function get_unfinish_today()
    {
        return self::query()
            ->whereNot('status', 'finished')
            ->whereDate('schedule', now())
            ->get();
    }
    public static function get_unfinish_tomorrow()
    {
        return self::query()
            ->whereNot('status', 'finished')
            ->whereDate('schedule', now()->addDays())
            ->get();
    }
    public static function get_unfinish_yesterday()
    {
        return self::query()
            ->whereNot('status', 'finished')
            ->whereDate('schedule', "<=", now()->subDays())
            ->get();
    }
    public static function get_unfinish_by_date($date)
    {
        return self::query()
            ->whereNot('status', 'finished')
            ->whereDate('schedule', $date)
            ->get();
    }
    public static function rating_midwife(Midwife $midwife)
    {

        $orders =  self::query()->where('midwife_id', $midwife->id)
            ->where('confirm', "yes")
            ->get();
        if ($orders) {
            $rating = 0;
            foreach ($orders as $order) {
                $rating += $order->rating;
            }
            return +number_format($rating / $orders->count(), 1, '.', "");
        } else {
            return 0;
        }
    }

    protected $fillable = [
        'status',
        'schedule',
        'schedule_start',
        'schedule_end',
        'location_name',
        'location_coordinates',
        'complaint',
        'rating',
        'patient_id',
        'midwife_id',
        'service_id',
    ];
    protected $casts = [
        'location_coordinates' => 'array',
    ];

    public function pregnancy_examination()
    {
        return $this->hasOne(PregnancyExamination::class);
    }
    public function family_planning()
    {
        return $this->hasOne(FamilyPlanning::class);
    }
    public function ear_pierching()
    {
        return $this->hasOne(EarPierching::class);
    }
    public function newborn_cares()
    {
        return $this->hasMany(NewbornCare::class);
    }
    public function postpartum_healths()
    {
        return $this->hasMany(PostpartumHealth::class);
    }
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
