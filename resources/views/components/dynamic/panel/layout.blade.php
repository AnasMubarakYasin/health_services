@switch($panel->template)
    @case('simple')
        <x-simple.panel.layout {{ $attributes }}></x-simple.panel.layout>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
