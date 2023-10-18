<?php

namespace App\Models;

use App\Dynamic\Helper;
use App\Dynamic\Resource\Definition;
use App\Dynamic\Trait\Formable;
use App\Dynamic\Trait\Statable;
use App\Dynamic\Trait\Tableable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Service extends Model
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;
    use Tableable, Formable, Statable;

    public static function modelable(): Model
    {
        return new self();
    }
    public static function defining()
    {
        self::$caption = "service";
        self::$definitions = [
            'name' => new Definition(
                name: 'name',
                type: 'string',
            ),
            'img' => new Definition(
                name: 'img',
                type: 'file',
                format: 'image/*',
            ),
            'description' => new Definition(
                name: 'description',
                type: 'string',
                format: "document",
            ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $fillable = [
        'name',
        'img',
        'description',
    ];

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Helper::file_url($value),
            set: fn ($value, $attributes) => Helper::file_store($value, @$attributes['img']),
        );
    }
}
