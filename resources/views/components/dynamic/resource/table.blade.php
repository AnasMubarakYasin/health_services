@aware(['panel', 'resource'])
@switch($panel->template)
    @case('simple')
        <x-simple.resource.table {{ $attributes }}>

        </x-simple.resource.table>
    @break

    @case('modern')
        <x-modern.data.table.regular {{ $attributes }}>

        </x-modern.data.table.regular>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
