@aware([
    'panel' => null,
])
<div class="grid grid-flow-col grid-cols-2 gap-4">
    <div class="h-fit p-4 bg-base-100 rounded-lg shadow-all-lg sm:p-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold leading-none text-base-content capitalize">
                {{ trans('unread') }}
            </h2>
            <form class="contents" action="{{ route('web.notification.mark_all') }}" method="post">
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
                    <li class="py-3 sm:py-4">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 pt-2">
                                <img class="w-8 h-8 rounded-full" src="{{ $notification->data['icon'] }}"
                                    alt="">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text font-bold text-base-content truncate ">
                                    {{ $notification->data['title'] }}
                                </h3>
                                <p class="text-sm font-medium text-base-content truncate ">
                                    {{ $notification->data['body'] }}
                                </p>
                                <div class="text-xs font-medium text-base-content/70 truncate">
                                    {{ $notification->created_at->timespan() }}
                                </div>
                            </div>
                            <a href="{{ route('web.notification.read', ['notification' => $notification]) }}"
                                class="relative grid place-items-center w-10 h-10 text-info/70 hover:bg-base-200 hover:text-info/100 rounded sm:rounded-lg transition-colors
                                        group-[#topbar&[data-button-interface='filled']]:bg-base-200
                                        group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                                        group-[#topbar&[data-button-interface='outlined']]:border-2
                                        group-[#topbar&[data-button-interface='outlined']]:border-base-300
                                        group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                data-te-placement="bottom" title="Open">
                                <x-icons.envelope_open class="w-5 h-5 sm:w-6 sm:h-6"
                                    stroke="2"></x-icons.envelope_open>
                            </a>
                        </div>
                    </li>
                @empty
                    <div class="text-center pt-4 text-base-content/70 text-lg">
                        {{ trans('empty') }}
                    </div>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="h-fit p-4 bg-base-100 rounded-lg shadow-all-lg sm:p-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold leading-none text-base-content capitalize">
                {{ trans('readed') }}
            </h2>
            <form class="contents" action="{{ route('web.notification.delete_all') }}" method="post">
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
                    <li class="py-3 sm:py-4">
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
                                    class="relative grid place-items-center w-10 h-10 text-error/70 hover:bg-base-200 hover:text-error/100 rounded sm:rounded-lg transition-colors
                                        group-[#topbar&[data-button-interface='filled']]:bg-base-200
                                        group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                                        group-[#topbar&[data-button-interface='outlined']]:border-2
                                        group-[#topbar&[data-button-interface='outlined']]:border-base-300
                                        group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                    data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                    data-te-placement="bottom" title="Delete">
                                    <x-icons.trash class="w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.trash>
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <div class="text-center pt-4 text-base-content/70 text-lg">
                        {{ trans('empty') }}
                    </div>
                @endforelse
            </ul>
        </div>
    </div>
</div>
