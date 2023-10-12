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

class EarPierching extends Model
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
            'name' => new Definition(
                name: 'name',
                type: 'string',
            ),
            'birthday' => new Definition(
                name: 'birthday',
                type: 'date',
            ),
            'age' => new Definition(
                name: 'age',
                type: 'number',
            ),
            'gender' => new Definition(
                name: 'gender',
                type: 'enum',
                enums: ['male' => 'male', 'female' => 'female'],
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
        'name',
        'birthday',
        'age',
        'gender',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
