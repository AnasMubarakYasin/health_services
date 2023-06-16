@template('simple')
    <x-simple.auth.signin {{ $attributes }} :user="$user" :demo="$demo" :data="$data">
        {{ $slot }}
    </x-simple.auth.signin>
@endtemplate
@template('modern')
    <x-modern.auth.signin {{ $attributes }} :user="$user" :demo="$demo" :data="$data">
        {{ $slot }}
    </x-modern.auth.signin>
@endtemplate
