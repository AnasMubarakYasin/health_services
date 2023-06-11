@switch($panel->template)
    @case('simple')
        <x-simple.panel.layout :panel="$panel" :title="$title"></x-simple.panel.layout>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
