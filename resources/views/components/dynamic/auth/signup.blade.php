@template('simple')
    <x-simple.auth.signup {{ $attributes }} :user="$user" :demo="$demo" :data="$data">
        {{ $slot }}
    </x-simple.auth.signup>
@endtemplate
@template('modern')
    <x-modern.auth.signup {{ $attributes }} :user="$user" :demo="$demo" :data="$data">
        {{ $slot }}
    </x-modern.auth.signup>
@endtemplate
