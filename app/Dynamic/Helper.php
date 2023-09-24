<?php

namespace App\Dynamic;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function file_store($value, $old, $base = '')
    {
        if (is_null($value)) {
            return null;
        } else if (is_string($value)) {
            return $value;
        } else {
            if ($old) {
                Storage::delete($old);
            }
            return Storage::put($base, $value);
        }
    }
    public static function file_url($value)
    {
        if (Str::of($value)->startsWith('http')) {
            return $value;
        } else {
            return Storage::url($value);
        }
    }
}
