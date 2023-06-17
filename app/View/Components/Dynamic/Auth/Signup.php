<?php

namespace App\View\Components\Dynamic\Auth;

use App\Dynamic\Entry;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Signup extends Component
{
    public array $data = [
        'name' => '',
        'email' => '',
        'password' => '',
    ];
    public bool $demo = false;
    public function __construct(public string $user = '')
    {
        $this->demo = request()->query->getBoolean('demo') && config('dynamic.application.enable_demo', false);
        if ($this->demo && $user) {
            $entry = Entry::create();
            $user = $entry->get_users()[$user];
            if (isset($user['account'])) {
                $this->data = $user['account'];
            } else {
                $this->data = collect($user['accounts'])->sole("role", request()->query('role'));
            }
        }
    }
    public function render(): View|Closure|string
    {
        return view('components.dynamic.auth.signup', [
            'data' => $this->data,
            'demo' => $this->demo,
        ]);
    }
}
