<?php

namespace App\View\Components\Dynamic;

use App\Dynamic\Entry as DynamicEntry;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class Entry extends Component
{
    public DynamicEntry $entry;
    public function __construct()
    {
        $this->entry = DynamicEntry::create();
    }
    public function render(): View|Closure|string
    {
        $date_planed = Carbon::parse($this->entry->config['aggrement']['finish_at']);
        $deadline = Carbon::parse(now())->diffInDays($date_planed);
        return view('components.dynamic.entry', [
            'entry' => $this->entry,
            'deadline' => $deadline,
            'done' => $this->entry->config['aggrement']['finished'],
        ]);
    }
}
