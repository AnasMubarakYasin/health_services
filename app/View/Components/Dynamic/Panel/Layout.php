<?php

namespace App\View\Components\Dynamic\Panel;

use App\Dynamic\Panel\Panel;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Layout extends Component
{
    public function __construct()
    {
    }
    public function render(): View|Closure|string
    {
        return view('components.dynamic.panel.layout', []);
    }
}
