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

class Administrator extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;
    use Tableable, Formable, Statable;

    public static function modelable(): Model
    {
        return new Administrator();
    }
    public static function defining()
    {
        self::$caption = "administrator";
        self::$definitions = [
            'photo' => new Definition(
                name: 'photo',
                type: 'file:image',
            ),
            'name' => new Definition(
                name: 'name',
                type: 'string',
            ),
            'fullname' => new Definition(
                name: 'fullname',
                type: 'string',
            ),
            'address' => new Definition(
                name: 'address',
                type: 'string',
            ),
            'telp' => new Definition(
                name: 'telp',
                type: 'string',
            ),
            'email' => new Definition(
                name: 'email',
                type: 'string',
            ),
            'password' => new Definition(
                name: 'password',
                type: 'string',
            ),
        ];
        self::$fetcher_relation = function ($definition) {
            return match ($definition->name) {
                default => throw new \Error("unknown name of $definition->name")
            };
        };
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo',
        'name',
        'fullname',
        'address',
        'telp',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
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
