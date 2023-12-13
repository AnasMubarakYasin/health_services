@aware(['panel', 'resource'])
@props([
    'name' => '',
    'count' => '',
    'icon' => '',
    'subcount' => '',
    'actions' => [],
])
<div class="flex flex-col p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
    <div class="w-full flex flex-row gap-2 items-center justify-between">
        <div class="flex flex-col self-start order-none">
            <div class="flex justify-between items-start gap-2 text-lg text-base-content/70 font-medium capitalize">
                <div class="flex-grow">{{ trans($name) }}</div>
                @if ($actions)
                    <div class="relative" data-te-dropdown-position="dropend">
                        <button {{-- href="{{ route('web.midwife.schedule.update', ['schedule' => $schedule['ids'][$key]]) }}" --}} class="" data-te-dropdown-toggle-ref>
                            <x-icons.ellipsis_vertical></x-icons.ellipsis_vertical>
                        </button>
                        <ul class="absolute z-10 m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-base-100 bg-clip-padding text-base shadow-all-lg [&[data-te-dropdown-show]]:block"
                            data-te-dropdown-menu-ref>
                            @foreach ($actions as $action)
                                <li>
                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm text-left font-normal text-base-content hover:bg-base-200 active:text-base-content active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-base-400 capitalize"
                                        href="{{ $action->href }}"
                                        data-te-dropdown-item-ref>{{ trans($action->name) }}</a>
                                </li>
                                {{-- <li>
                                    <form action="{{ route('web.midwife.order.done', ['order' => $order]) }}" method="post" class="contents">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm text-left font-normal text-base-content hover:bg-base-200 active:text-base-content active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-base-400 capitalize"
                                            data-te-dropdown-item-ref>
                                            {{ trans('finish') }}
                                        </button>
                                    </form>
                                </li> --}}
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="text-xl text-base-content font-medium"
                style="overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;">
                {{ $count }}
            </div>
        </div>
        <div class="p-2 bg-primary/10 text-primary rounded-md self-center order-none">
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
