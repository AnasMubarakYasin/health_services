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
                    'senin' => 'senin', 'selasa' => 'selasa', 'rabu' => 'rabu', 'kamis' => 'kamis', 'jumat' => 'jumat', 'sabtu' => 'sabtu', 'minggu' => 'minggu'
                ]
            ),
            'midwive' => new Definition(
                name: 'midwive',
                type: 'model',
                array: false,
                relation: 'midwive',
                alias: 'midwive_id',
            ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $fillable = [
        'day', 'midwive_id'
    ];

    public function midwive()
    {
        return $this->belongsTo(Midwife::class, 'midwive_id');
    }

    public function visits()
    {
        return visits($this);
    }
}
