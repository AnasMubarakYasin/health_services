<?php

namespace App\View\Components\Simple\Panel;

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
    public Panel $panel;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        /** @var User */
        $user = Auth::user();

        $template = Session::get('template', config('dynamic.application.template'));

        $panel = Panel::create($user::class);
        $panel->user = $user;
        $panel->locale = Session::get("locale_$user->id", App::getLocale());
        $panel->template = $template;
        $panel->preference = Session::get("preference_$user->id", []);
        $panel->token = $user->createToken('generic')->plainTextToken;

        $this->panel = $panel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.simple.panel.layout', [
            'panel' => $this->panel,
        ]);
    }
}
