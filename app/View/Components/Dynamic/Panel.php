<?php

namespace App\View\Components\Dynamic;

use App\Dynamic\Panel\Panel as DynamicPanel;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Panel extends Component
{
    public mixed $panel;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        /** @var User */
        $user = Auth::user();

        $template = Session::get('template', config('dynamic.application.template'));

        $panel = DynamicPanel::create($user::class);
        $panel->user = $user;
        $panel->locale = Session::get("locale_$user->id", App::getLocale());
        $panel->template = $template;
        $panel->preference = Session::get("preference_$user->id", new \stdClass());

        $token = $user->currentAccessToken();
        if (!$token) {
            $token = $user->createToken("panel");
            $user->withAccessToken($token);
        }
        $panel->token = $token->plainTextToken;

        $this->panel = $panel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dynamic.panel', [
            'panel' => $this->panel,
        ]);
    }
}
