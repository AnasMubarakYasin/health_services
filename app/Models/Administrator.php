<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Dynamic\Resource\Definition;
use App\Dynamic\Trait\Formable;
use App\Dynamic\Trait\Statable;
use App\Dynamic\Trait\Tableable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use Spatie\DeletedModels\Models\DeletedModel;

class Administrator extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;
    use Tableable, Formable, Statable;
    use KeepsDeletedModels;

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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function setPhotoAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes['photo'] = null;
        } else if (is_string($value)) {
            $this->attributes['photo'] = $value;
        } else {
            if (isset($this->attributes['photo'])) {
                Storage::delete($this->attributes['photo']);
            }
            $path = $this->id ? "$this->id" : 'temp';
            $this->attributes['photo'] = Storage::put("administrator/$path", $value);
        }
    }
    public function getPhotoUrlAttribute()
    {
        if (Str::of($this->photo)->startsWith('http')) {
            return $this->photo;
        } else {
            return Storage::url($this->photo);
        }
    }

    public function visits()
    {
        return visits($this);
    }
}
