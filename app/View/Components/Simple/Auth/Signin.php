<?php

namespace App\View\Components\Simple\Auth;

use App\Dynamic\Entry;
use Illuminate\View\Component;

class Signin extends Component
{
    public array $data = [
        'name' => '',
        'password' => '',
    ];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $for = '')
    {
        $demo = request()->query->getBoolean('demo') && config('dynamic.application.enable_demo', false);
        if ($demo && $for) {
            $entry = Entry::create();
            $user = $entry->get_users()[$for];
            if (isset($user['account'])) {
                $this->data = $user['account'];
            } else {
                $this->data = collect($user['accounts'])->sole("role", request()->query('role'));
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.simple.auth.signin', [
            'data' => $this->data,
        ]);
    }
}
