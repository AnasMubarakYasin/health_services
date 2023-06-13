<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Template extends Controller
{
    public function set(string $template)
    {
        session()->put('template', $template);

        return back();
    }
}
