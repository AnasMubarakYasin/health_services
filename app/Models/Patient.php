<?php

namespace App\Models;

use App\Dynamic\Fileable;
use App\Dynamic\Helper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Dynamic\Resource\Definition;
use App\Dynamic\Trait\Formable;
use App\Dynamic\Trait\Statable;
use App\Dynamic\Trait\Tableable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;

class Patient extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;
    use Tableable, Formable, Statable;
    use Fileable;
    use HasPushSubscriptions;

    public static function modelable(): Model
    {
        return new self();
    }
    public static function defining()
    {
        self::$caption = "patient";
        self::$definitions = [
            'name' => new Definition(
                name: 'name',
                type: 'string',
            ),
            'password' => new Definition(
                name: 'password',
                type: 'string',
                format: 'password',
            ),
            'photo' => new Definition(
                name: 'photo',
                type: 'file',
                format: 'image/*',
                nullable: true,
            ),
            'fullname' => new Definition(
                name: 'fullname',
                type: 'string',
                nullable: true,
            ),
            'email' => new Definition(
                name: 'email',
                type: 'string',
                format: 'email',
                nullable: true,
            ),
            'telp' => new Definition(
                name: 'telp',
                type: 'string',
                format: 'tel',
                nullable: true,
            ),
            'age' => new Definition(
                name: 'age',
                type: 'number',
                nullable: true,
            ),
            'weight' => new Definition(
                name: 'weight',
                type: 'number',
                nullable: true,
            ),
            'height' => new Definition(
                name: 'height',
                type: 'number',
                nullable: true,
            ),
            'date_of_birth' => new Definition(
                name: 'date of birth',
                type: 'date',
                nullable: true,
            ),
            'place_of_birth' => new Definition(
                name: 'place of birth',
                type: 'string',
                nullable: true,
            ),
            'gender' => new Definition(
                name: 'gender',
                type: 'enum',
                enums: [
                    'male' => 'male',
                    'female' => 'female',
                ],
                nullable: true,
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
        'password',
        'photo',
        'fullname',
        'email',
        'telp',
        'age',
        'weight',
        'height',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'remember_token',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Helper::file_url($value),
            set: fn ($value, $attributes) => Helper::file_store($value, @$attributes['photo']),
        );
    }
}
