<?php

namespace App\View\Components\Panel;

use App\Dynamic\Welcome as WelcomeInfo;
use App\Dynamic\Updates;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class Welcome extends Component
{
    public WelcomeInfo $info;
    public mixed $updates;
    public function __construct()
    {
        $this->info = WelcomeInfo::create();
        $this->info->locale = App::getLocale();
        $this->updates = new Updates();
        $this->updates->load();
        $this->updates->generate_changes();
    }
    public function render()
    {
        return view('components.panel.welcome', [
            'info' => $this->info,
            'updates' => $this->updates,
        ]);
    }
}
