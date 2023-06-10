<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Locale extends Controller
{
    public function set(string $locale)
    {
        session()->put('locale', $locale);

        return back();
    }
}
