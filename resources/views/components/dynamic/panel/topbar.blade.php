@aware(['panel'])
@dd($panel)
@switch($panel->template)
    @case('simple')
        <x-simple.panel.layout :panel="$panel"></x-simple.panel.layout>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
