@aware(['panel'])
@switch($panel->template)
    @case('simple')
        <x-simple.panel.main {{ $attributes }}></x-simple.panel.main>
    @break

    @case('modern')
        <x-modern.dashboard.main {{ $attributes }}></x-modern.dashboard.main>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
