<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Dynamic\Fileable;
use App\Dynamic\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Dynamic\Resource\Definition;
use App\Dynamic\Trait\Formable;
use App\Dynamic\Trait\Statable;
use App\Dynamic\Trait\Tableable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use Spatie\DeletedModels\Models\DeletedModel;

class Administrator extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;
    use Tableable, Formable, Statable;
    use Fileable;

    public static function modelable(): Model
    {
        return new self();
    }
    public static function defining()
    {
        self::$caption = "administrator";
        self::$definitions = [
            'photo' => new Definition(
                name: 'photo',
                type: 'file',
                format: 'image/*',
                nullable: true,
            ),
            'name' => new Definition(
                name: 'name',
                type: 'string',
            ),
            'fullname' => new Definition(
                name: 'fullname',
                type: 'string',
                nullable: true,
            ),
            'address' => new Definition(
                name: 'address',
                type: 'string',
                nullable: true,
            ),
            'telp' => new Definition(
                name: 'telp',
                type: 'string',
                format: 'tel',
                nullable: true,
            ),
            'email' => new Definition(
                name: 'email',
                type: 'string',
                format: 'email',
                nullable: true,
            ),
            'password' => new Definition(
                name: 'password',
                type: 'string',
                format: 'password',
            ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    protected $fileable = ['photo'];
    protected $file_basepath = 'administrator';
    protected $file_visiblity = 'public';

    protected $fillable = [
        'photo',
        'name',
        'fullname',
        'address',
        'telp',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => bcrypt($value),
        );
    }
    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->file_url($attributes['photo'])
        );
    }
}
