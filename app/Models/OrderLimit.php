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

class OrderLimit extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    use Tableable, Formable, Statable;

    public static function modelable(): Model
    {
        return new self();
    }
    public static function defining()
    {
        self::$caption = "order limit";
        self::$definitions = [
            'limit' => new Definition(
                name: 'limit',
                type: 'number',
            ),
            'date' => new Definition(
                name: 'date',
                type: 'date',
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

    public static function find_by_midwife_date(Midwife $midwife, $date)
    {
        return self::query()
            ->whereDate('date', $date)
            ->where('midwife_id', $midwife->id)
            ->first();
    }
    public static function find_by_midwife(Midwife $midwife)
    {
        return self::query()
            ->where('midwife_id', $midwife->id)
            ->first();
    }

    protected $fillable = [
        'limit',
        'date',
        'midwife_id',
    ];

    public function midwife()
    {
        return $this->belongsTo(Midwife::class, 'midwife_id');
    }
}
