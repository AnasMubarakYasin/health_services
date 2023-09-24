<?php

namespace App\Dynamic;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

trait Fileable
{
    // protected $fileable = [];
    // protected $file_basepath = '';
    // protected $file_visiblity = 'public';
    public function fill(array $attributes)
    {
        parent::fill(Arr::except($attributes, $this->fileable));
        foreach (Arr::only($attributes, $this->fileable) as $key => $value) {
            if (is_null($value)) {
                $this->attributes[$key] = null;
            } else if (is_string($value)) {
                $this->attributes[$key] = $value;
            } else {
                if (isset($this->attributes[$key])) {
                    Storage::delete($this->attributes[$key]);
                }
                $path = $this->attributes['id'] ?: Str::uuid();
                $base = $this->file_basepath;
                $this->attributes[$key] = Storage::put("$base/$path", $value, $this->file_visiblity);
            }
        }
        return $this;
    }
    public function file_url($value) {
        return Storage::url($value);
    }
}
