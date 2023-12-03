@aware([
    'panel' => null,
])

<div class="@container">
    <div class="@2xl:hidden p-2 bg-base-100 shadow-all-lg rounded-lg">
        <ul class="flex flex-row flex-wrap list-none border-b-0" role="tablist" data-te-nav-ref>
            <li role="presentation">
                <h2>
                    <a href="#tabs-unread"
                        class="block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-base font-medium hover:isolate hover:border-transparent hover:bg-base-200 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary capitalize"
                        data-te-toggle="pill" data-te-target="#tabs-unread" data-te-nav-active role="tab"
                        aria-controls="tabs-unread" aria-selected="true">{{ trans('unread') }}</a>
                </h2>
            </li>
            <li role="presentation">
                <h2>
                    <a href="#tabs-readed"
                        class="block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-base font-medium hover:isolate hover:border-transparent hover:bg-base-200 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary capitalize"
                        data-te-toggle="pill" data-te-target="#tabs-readed" role="tab" aria-controls="tabs-readed"
                        aria-selected="false">{{ trans('readed') }}</a>
                </h2>
            </li>
        </ul>
        <div class="">
            <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                id="tabs-unread" role="tabpanel" aria-labelledby="tabs-unread-tab" data-te-tab-active>
                <div class="">
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-base-300">
                            @forelse ($panel->user->unreadNotifications as $notification)
                                <li class="px-2 py-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0 pt-2">
                                            <img class="w-8 h-8 rounded-full" src="{{ $notification->data['icon'] }}"
                                                alt="">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text font-bold text-base-content truncate ">
                                                {{ $notification->data['title'] }}
                                            </h3>
                                            <p class="text-sm font-medium text-base-content text-ellipsis">
                                                {{ $notification->data['body'] }}
                                            </p>
                                            <div class="text-xs font-medium text-base-content/70 truncate">
                                                {{ $notification->created_at->timespan() }}
                                            </div>
                                        </div>
                                        <a href="{{ route('web.notification.read', ['notification' => $notification]) }}"
                                            class="relative grid place-items-center w-10 h-10 text-info/70 hover:bg-base-200 hover:text-info/100 rounded @2xl:rounded-lg transition-colors
                                                    group-[#topbar&[data-button-interface='filled']]:bg-base-200
                                                    group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                                                    group-[#topbar&[data-button-interface='outlined']]:border-2
                                                    group-[#topbar&[data-button-interface='outlined']]:border-base-300
                                                    group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                            data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                            data-te-placement="bottom" title="Open">
                                            <x-icons.envelope_open class="w-5 h-5 @2xl:w-6 @2xl:h-6"
                                                stroke="2"></x-icons.envelope_open>
                                        </a>
                                    </div>
                                </li>
                            @empty
                                <div class="text-center pt-4 text-base-content/70 text-lg capitalize">
                                    {{ trans('empty') }}
                                </div>
                            @endforelse
                            @if (filled($panel->user->unreadNotifications))
                                <form class="contents" action="{{ route('web.notification.mark_all', ['id' => $panel->user]) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="w-full p-2 text-sm font-medium text-center text-info/70 hover:bg-base-200 hover:text-info/100 transition-colors rounded-lg capitalize">
                                        {{ trans_choice('mark', 2) }}
                                    </button>
                                </form>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                id="tabs-readed" role="tabpanel" aria-labelledby="tabs-readed-tab">
                <div class="">
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-base-300">
                            @forelse ($panel->user->readnotifications as $notification)
                                <li class="px-2 py-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0 pt-2">
                                            <img class="w-8 h-8 rounded-full" src="{{ $notification->data['icon'] }}"
                                                alt="">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text font-bold text-base-content truncate ">
                                                {{ $notification->data['title'] }}
                                            </h3>
                                            <p class="text-sm font-medium text-base-content text-ellipsis">
                                                {{ $notification->data['body'] }}
                                            </p>
                                            <div class="text-xs font-medium text-base-content/70 truncate">
                                                {{ $notification->created_at->timespan() }}
                                            </div>
                                        </div>
                                        <form class="contents"
                                            action="{{ route('web.notification.delete', ['notification' => $notification]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="relative grid place-items-center w-10 h-10 text-error/70 hover:bg-base-200 hover:text-error/100 rounded @2xl:rounded-lg transition-colors
                                                    group-[#topbar&[data-button-interface='filled']]:bg-base-200
                                                    group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                                                    group-[#topbar&[data-button-interface='outlined']]:border-2
                                                    group-[#topbar&[data-button-interface='outlined']]:border-base-300
                                                    group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                                data-te-ripple-init data-te-ripple-color="primary"
                                                data-te-toggle="tooltip" data-te-placement="bottom" title="Delete">
                                                <x-icons.trash class="w-5 h-5 @2xl:w-6 @2xl:h-6"
                                                    stroke="2"></x-icons.trash>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <div class="text-center py-4 text-base-content/70 text-lg capitalize">
                                    {{ trans('empty') }}
                                </div>
                            @endforelse
                            @if (filled($panel->user->readnotifications))
                                <form class="contents" action="{{ route('web.notification.delete_all', ['id' => $panel->user]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="w-full p-2 text-sm font-medium text-center text-error/70 hover:bg-base-200 hover:text-error/100 transition-colors rounded-lg capitalize">
                                        {{ trans_choice('delete', 2) }}
                                    </button>
                                </form>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden @2xl:grid grid-cols-2 gap-4">
        <div class="h-fit p-4 bg-base-100 rounded-lg shadow-all-lg @2xl:p-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold leading-none text-base-content capitalize">
                    {{ trans('unread') }}
                </h2>
                <form class="contents" action="{{ route('web.notification.mark_all', ['id' => $panel->user]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button class="text-sm font-medium text-info hover:underline capitalize">
                        {{ trans_choice('mark', 2) }}
                    </button>
                </form>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-base-300">
                    @forelse ($panel->user->unreadNotifications as $notification)
                        <li class="py-3 @2xl:py-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 pt-2">
                                    <img class="w-8 h-8 rounded-full" src="{{ $notification->data['icon'] }}"
                                        alt="">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text font-bold text-base-content truncate ">
                                        {{ $notification->data['title'] }}
                                    </h3>
                                    <p class="text-sm font-medium text-base-content text-ellipsis">
                                        {{ $notification->data['body'] }}
                                    </p>
                                    <div class="text-xs font-medium text-base-content/70 truncate">
                                        {{ $notification->created_at->timespan() }}
                                    </div>
                                </div>
                                <a href="{{ route('web.notification.read', ['notification' => $notification]) }}"
                                    class="relative grid place-items-center w-10 h-10 text-info/70 hover:bg-base-200 hover:text-info/100 rounded @2xl:rounded-lg transition-colors
                                            group-[#topbar&[data-button-interface='filled']]:bg-base-200
                                            group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                                            group-[#topbar&[data-button-interface='outlined']]:border-2
                                            group-[#topbar&[data-button-interface='outlined']]:border-base-300
                                            group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                    data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                    data-te-placement="bottom" title="Open">
                                    <x-icons.envelope_open class="w-5 h-5 @2xl:w-6 @2xl:h-6"
                                        stroke="2"></x-icons.envelope_open>
                                </a>
                            </div>
                        </li>
                    @empty
                        <div class="text-center pt-4 text-base-content/70 text-lg capitalize">
                            {{ trans('empty') }}
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="h-fit p-4 bg-base-100 rounded-lg shadow-all-lg @2xl:p-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold leading-none text-base-content capitalize">
                    {{ trans('readed') }}
                </h2>
                <form class="contents" action="{{ route('web.notification.delete_all', ['id' => $panel->user]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="text-sm font-medium text-error hover:underline capitalize">
                        {{ trans_choice('delete', 2) }}
                    </button>
                </form>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-base-300">
                    @forelse ($panel->user->readnotifications as $notification)
                        <li class="py-3 @2xl:py-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 pt-2">
                                    <img class="w-8 h-8 rounded-full" src="{{ $notification->data['icon'] }}"
                                        alt="">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text font-bold text-base-content truncate ">
                                        {{ $notification->data['title'] }}
                                    </h3>
                                    <p class="text-sm font-medium text-base-content text-ellipsis">
                                        {{ $notification->data['body'] }}
                                    </p>
                                    <div class="text-xs font-medium text-base-content/70 truncate">
                                        {{ $notification->created_at->timespan() }}
                                    </div>
                                </div>
                                <form class="contents"
                                    action="{{ route('web.notification.delete', ['notification' => $notification]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="relative grid place-items-center w-10 h-10 text-error/70 hover:bg-base-200 hover:text-error/100 rounded @2xl:rounded-lg transition-colors
                                            group-[#topbar&[data-button-interface='filled']]:bg-base-200
                                            group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                                            group-[#topbar&[data-button-interface='outlined']]:border-2
                                            group-[#topbar&[data-button-interface='outlined']]:border-base-300
                                            group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                        data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                        data-te-placement="bottom" title="Delete">
                                        <x-icons.trash class="w-5 h-5 @2xl:w-6 @2xl:h-6"
                                            stroke="2"></x-icons.trash>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <div class="text-center pt-4 text-base-content/70 text-lg capitalize">
                            {{ trans('empty') }}
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
