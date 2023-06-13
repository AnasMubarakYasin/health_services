@aware(['panel'])
@switch($panel->template)
    @case('simple')
        <x-simple.panel.main {{ $attributes }}>{{ $slot }}</x-simple.panel.main>
    @break

    @case('modern')
        <x-modern.dashboard.main {{ $attributes }}>{{ $slot }}</x-modern.dashboard.main>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
