<?php

namespace App\View\Components\Simple\Auth;

use App\Dynamic\Entry;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Signin extends Component
{
    public function __construct()
    {
    }
    public function render(): View|Closure|string
    {
        return view('components.simple.auth.signin');
    }
}
