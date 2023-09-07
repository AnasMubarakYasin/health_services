@aware(['panel', 'resource'])
@props([
    'name' => '',
    'count' => '',
    'icon' => '',
    'subcount' => '',
])
<div class="flex flex-col p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
    <div class="w-full flex flex-col sm:flex-row gap-2 items-center justify-between">
        <div class="flex flex-col order-2 self-start sm:order-none">
            <div class="text-lg text-base-content/70 font-medium capitalize">
                {{ trans($name) }}
            </div>
            <div class="text-xl text-base-content font-medium">
                {{ $count }}
            </div>
        </div>
        <div class="p-2 bg-primary/10 text-primary rounded-md self-start sm:self-center order-1 sm:order-none">
            {{ $icon }}
        </div>
    </div>
    @if ($subcount)
        <div class="text-base text-base-content/70">
            {{ $subcount }}
        </div>
    @endif
    {{ $slot }}
</div>
