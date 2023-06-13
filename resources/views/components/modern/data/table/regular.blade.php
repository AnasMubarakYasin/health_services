@aware(['resource'])
@props([
    'menu' => true,
    'selection' => true,
    'action' => true,
    'top' => null,
    'actions' => null,
])
<div class="flex flex-col gap-4">
    <section class="flex gap-2">
        <button
            class="grid place-items-center w-10 h-10 bg-primary text-primary-content rounded-lg transition-colors
                hover:bg-primary-focus"
            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip" data-te-placement="bottom"
            title="Create">
            <x-icons.add class="w-6 h-6" stroke="2">
            </x-icons.add>
        </button>
        <button
            class="grid place-items-center w-10 h-10 bg-base-100 text-base-content/70 rounded-lg transition-colors
                hover:bg-base-300 hover:text-base-content/100"
            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip" data-te-placement="bottom"
            title="Column">
            <x-icons.column class="w-6 h-6" stroke="2">
            </x-icons.column>
        </button>
    </section>
    <section class="overflow-auto">
        <table class="w-full h-full">
            <thead>
                <tr>
                    <th
                        class="block px-2 bg-base-100 w-full h-full border-t-2 rounded-tl-xl border-l-2 border-base-300">
                    </th>
                    <th
                        class="p-4 pl-0 bg-base-100 text-base text-left align-middle font-semibold border-t-2 border-base-300">
                        <div class="grid place-items-center place-content-center w-full h-full">
                            <input type="checkbox" name="" id=""
                                class="appearance-none relative w-5 h-5 border-2 border-base-300 rounded cursor-pointer ring-offset-base-100 !outline-none transition-all after:transition-all
                                hover:bg-base-200 hover:ring-2 hover:ring-base-300 hover:ring-offset-2
                                focus-visible:ring-2 focus-visible:ring-primary  focus-visible:ring-offset-2
                                checked:!bg-primary checked:ring-2 checked:!ring-primary checked:ring-offset-2 checked:after:w-1/2 checked:after:h-full checked:after:rotate-45 checked:after:scale-[0.75] checked:after:left-[5px] checked:after:bottom-0.5 checked:after:border-r-4 checked:after:border-b-4
                                indeterminate:!bg-primary indeterminate:ring-2 indeterminate:ring-primary indeterminate:ring-offset-2
                                after:content-[''] after:absolute after:bg-transparent after:border-primary-content
                                indeterminate:after:w-0 indeterminate:after:h-full indeterminate:after:bg-transparent indeterminate:after:rotate-90 indeterminate:after:border-r-4 indeterminate:after:border-b-4 indeterminate:after:border-primary-content indeterminate:after:left-[7px] indeterminate:after:bottom-0 indeterminate:after:scale-[0.55]">
                        </div>
                    </th>
                    <th
                        class="p-4 bg-base-100 text-base text-center align-middle font-semibold border-l-2 border-t-2 border-base-300">
                        #
                    </th>
                    @foreach ($resource->columns as $column)
                        <th
                            class="p-4 bg-base-100 text-base text-left align-middle font-semibold border-t-2 border-l-2 border-base-300">
                            <div class="flex justify-between items-center">
                                <div class="whitespace-nowrap">{{ trans($resource->model->definition($column)->name) }}
                                </div>
                                @if (request()->query('sort_dir', 'desc') == 'desc')
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'on', 'sort_name' => $column, 'sort_dir' => 'asc']) }}"
                                        role="button"
                                        class="grid place-items-center w-8 h-8 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg transition-colors
                                            group-[#topbar&[data-button-interface='filled']]:bg-primary/30
                                            group-[#topbar&[data-button-interface='filled']]:hover:bg-primary/50
                                            group-[#topbar&[data-button-interface='outlined']]:border-2
                                            group-[#topbar&[data-button-interface='outlined']]:border-primary
                                            group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                        data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                        data-te-placement="bottom" title="Ascending">
                                        <x-icons.chevron_up class=" w-5 h-5" stroke="2" />
                                    </a>
                                @else
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'on', 'sort_name' => $column, 'sort_dir' => 'desc']) }}"
                                        role="button"
                                        class="grid place-items-center w-8 h-8 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg transition-colors
                                        group-[#topbar&[data-button-interface='filled']]:bg-primary/30
                                        group-[#topbar&[data-button-interface='filled']]:hover:bg-primary/50
                                        group-[#topbar&[data-button-interface='outlined']]:border-2
                                        group-[#topbar&[data-button-interface='outlined']]:border-primary
                                        group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                        data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                        data-te-placement="bottom" title="Descending">
                                        <x-icons.chevron_down class=" w-5 h-5" stroke="2" />
                                    </a>
                                @endif
                            </div>
                        </th>
                    @endforeach
                    <th
                        class="p-4 bg-base-100 text-base text-center align-middle font-semibold border-t-2 border-l-2 border-base-300">
                        Action
                    </th>
                    <th class="block px-2 bg-base-100 w-2 h-full border-t-2 rounded-tr-xl border-r-2 border-base-300">
                    </th>
                </tr>
                <tr>
                    <td class="block px-2 bg-base-100 w-full h-full border-l-2 border-t-2 border-base-300"></td>
                    <th
                        class="p-2 pl-0 bg-base-100 text-base text-center align-middle font-semibold border-t-2 border-base-200">
                    </th>
                    <th
                        class="p-2 bg-base-100 text-base text-center align-middle font-semibold border-l-2 border-t-2 border-base-200">
                    </th>
                    @foreach ($resource->columns as $column)
                        <td
                            class="p-2 bg-base-100 text-base text-left align-middle font-semibold border-t-2 border-l-2 border-base-300">
                            <div class="relative" data-te-input-wrapper-init>
                                <input type="text"
                                    class="peer block w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />
                            </div>
                        </td>
                    @endforeach
                    <td
                        class="p-2 bg-base-100 text-base text-left align-middle font-semibold border-t-2 border-l-2 border-base-300">
                    </td>
                    <td class="block px-2 bg-base-100 w-2 h-full border-r-2 border-t-2 border-base-300">
                    </td>
                </tr>
            </thead>
            <tbody>
                @forelse($paginator ?? $all as $item)
                    <tr>
                        <td class="block px-2 bg-base-100 w-full h-full border-l-2 border-t-2 border-base-300">
                        </td>
                        <th
                            class="p-4 pl-0 bg-base-100 text-base text-center align-middle font-semibold border-t-2 border-base-200">
                            <div class="grid place-items-center place-content-center w-full h-full">
                                <input type="checkbox" name="" id=""
                                    class="appearance-none relative w-5 h-5 border-2 border-base-300 rounded cursor-pointer !outline-none transition-all after:transition-all
                                hover:bg-base-200 hover:ring-2 hover:ring-base-300 hover:ring-offset-2
                                focus-visible:ring-2 focus-visible:ring-primary  focus-visible:ring-offset-2
                                checked:!bg-primary checked:ring-2 checked:!ring-primary checked:ring-offset-2 checked:after:w-1/2 checked:after:h-full checked:after:rotate-45 checked:after:scale-[0.75] checked:after:left-[5px] checked:after:bottom-0.5 checked:after:border-r-4 checked:after:border-b-4
                                indeterminate:!bg-primary indeterminate:ring-2 indeterminate:ring-primary indeterminate:ring-offset-2
                                after:content-[''] after:absolute after:bg-transparent after:border-base-100
                                indeterminate:after:w-0 indeterminate:after:h-full indeterminate:after:bg-transparent indeterminate:after:rotate-90 indeterminate:after:border-r-4 indeterminate:after:border-b-4 indeterminate:after:border-base-100 indeterminate:after:left-[7px] indeterminate:after:bottom-0 indeterminate:after:scale-[0.55]">
                            </div>
                        </th>
                        <th
                            class="p-4 bg-base-100 text-base text-center align-middle font-semibold border-l-2 border-t-2 border-base-200">
                            {{ $loop->iteration }}
                        </th>
                        @foreach ($resource->columns as $column)
                            <td
                                class="p-4 bg-base-100 text-base text-left whitespace-nowrap align-middle font-normal border-l-2 border-t-2 border-base-300">
                                @if (is_array($item->{$column}))
                                    {{ implode(', ', $item->{$column}) }}
                                @else
                                    {{ $item->{$column} }}
                                @endif
                            </td>
                        @endforeach
                        <td
                            class="p-4 pr-0 bg-base-100 text-base text-left align-middle font-normal border-l-2 border-t-2 border-base-300">
                            <div class="flex justify-center items-center gap-2 w-full">
                                <button
                                    class="grid place-items-center w-10 h-10 bg-success/90 text-success-content/90 rounded-lg transition-colors
                             hover:bg-success/100 hover:text-success-content/100"
                                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                                    data-te-placement="bottom" title="Show">
                                    <x-icons.eye_on class="w-6 h-6" stroke="2">
                                    </x-icons.eye_on>
                                </button>
                                <button
                                    class="grid place-items-center w-10 h-10 bg-info/90 text-info-content/90 rounded-lg transition-colors
                                 hover:bg-info/100 hover:text-info-content/100"
                                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                                    data-te-placement="bottom" title="Edit">
                                    <x-icons.edit class="w-6 h-6" stroke="2">
                                    </x-icons.edit>
                                </button>
                                <button
                                    class="grid place-items-center w-10 h-10 bg-danger/90 text-danger-content/90 rounded-lg transition-colors
                                 hover:bg-danger/100 hover:text-danger-content/100"
                                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                                    data-te-placement="bottom" title="Delete">
                                    <x-icons.delete class="w-6 h-6" stroke="2">
                                    </x-icons.delete>
                                </button>
                            </div>
                        </td>
                        <td class="block px-2 bg-base-100 w-2 h-full border-r-2 border-t-2 border-base-300">
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th
                        class="block min-w-[4px] w-full h-4 px-2 bg-base-100 border-b-2 rounded-bl-xl border-l-2 border-base-300">
                    </th>
                    <th class="px-2 bg-base-100 h-4 border-b-2 border-base-300"></th>
                    <th class="px-2 bg-base-100 h-4 border-b-2 border-base-300"></th>
                    @foreach ($resource->columns as $column)
                        <th class="px-2 bg-base-100 h-4 border-b-2 border-l-2 border-base-300"></th>
                    @endforeach
                    <th class="px-2 bg-base-100 h-4 border-b-2 border-l-2 border-base-300"></th>
                    <th class="block w-2 h-4 px-2 bg-base-100 border-b-2 rounded-br-xl border-r-2 border-base-300">
                    </th>
                </tr>
            </tfoot>
        </table>
    </section>
    <section class="flex justify-between items-center">
        <nav class="flex gap-8 items-center">
            <ul class="flex gap-2 items-center">
                <li>
                    @if ($paginator->previousPageUrl())
                        <a href="{{ $paginator->previousPageUrl() }}" aria-details="{{ trans('previous') }}"
                            class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100 border-2 border-base-300 rounded-lg transition-colors
                        hover:bg-primary/30 hover:text-base-content/100
                        aria-selected:bg-primary/100 aria-selected:text-primary-content
                        aria-disabled:bg-base-100/50 aria-disabled:text-base-content/50 aria-disabled:cursor-not-allowed aria-disabled:select-none"
                            data-te-toggle="tooltip" data-te-placement="bottom" title="Previous">
                            <x-icons.chevron_left class="w-4 h-4" stroke="3">
                            </x-icons.chevron_left>
                        </a>
                    @else
                        <div aria-disabled="true" aria-details="{{ trans('previous') }}"
                            class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100 border-2 border-base-300 rounded-lg transition-colors
                            hover:bg-primary/30 hover:text-base-content/100
                            aria-selected:bg-primary/100 aria-selected:text-primary-content
                            aria-disabled:bg-base-100/50 aria-disabled:text-base-content/50 aria-disabled:cursor-not-allowed aria-disabled:select-none"
                            data-te-toggle="tooltip" data-te-placement="bottom" title="Previous">
                            <x-icons.chevron_left class="w-4 h-4" stroke="3">
                            </x-icons.chevron_left>
                        </div>
                    @endif
                </li>
                @php
                    $count = (int) floor($paginator->total() / $paginator->perPage());
                @endphp
                @if ($count && $count > 1)
                    @php
                        $index = 1;
                        $limit = 5;
                        if ($count > $limit) {
                            $div = floor($limit / 2);
                            $start = $paginator->currentPage() - $div;
                            $percent = ($paginator->currentPage() / $count) * 100;
                            if ($start < 1) {
                                $start = 1;
                            } else {
                                if ($paginator->currentPage() + $div > $count) {
                                    $start = $count - ($limit - 1);
                                }
                            }
                            $pages = range($start, $limit + ($start - 1));
                            if (in_array(1, $pages)) {
                                $elements = [$pages, '', [$count]];
                            } elseif (in_array($count, $pages)) {
                                $elements = [[1], '', $pages];
                            } else {
                                $elements = [[1], '', $pages, '', [$count]];
                            }
                        } else {
                            $elements = [range(1, $count)];
                        }
                    @endphp
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li>
                                <div
                                    class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100/30 border-2 border-base-300 rounded-lg transition-colors">
                                    <div class="font-semibold">...</div>
                                </div>
                            </li>
                        @else
                            @foreach ($element as $page)
                                @if ($paginator->currentPage() == $page)
                                    <li>
                                        <div aria-selected="true"
                                            class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100 border-2 border-base-300 rounded-lg transition-colors
                                            hover:bg-primary/30 hover:text-base-content/100
                                            aria-selected:bg-primary/100 aria-selected:text-primary-content
                                            aria-disabled:bg-base-100/50 aria-disabled:text-base-content/50 aria-disabled:cursor-not-allowed aria-disabled:select-none"
                                            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                                            data-te-placement="bottom" title="Page">
                                            <div class="font-semibold">
                                                {{ $page }}
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $paginator->url($page) }}"
                                            class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100 border-2 border-base-300 rounded-lg transition-colors
                                hover:bg-primary/30 hover:text-base-content/100
                                aria-selected:bg-primary/100 aria-selected:text-primary-content
                                aria-disabled:bg-base-100/50 aria-disabled:text-base-content/50 aria-disabled:cursor-not-allowed aria-disabled:select-none"
                                            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                                            data-te-placement="bottom" title="Page">
                                            <div class="font-semibold">
                                                {{ $page }}
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @else
                    @foreach (range(1, $count + 1) as $page)
                        @if ($paginator->currentPage() == $page)
                            <li>
                                <div aria-selected="true"
                                    class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100 border-2 border-base-300 rounded-lg transition-colors
                                            hover:bg-primary/30 hover:text-base-content/100
                                            aria-selected:bg-primary/100 aria-selected:text-primary-content
                                            aria-disabled:bg-base-100/50 aria-disabled:text-base-content/50 aria-disabled:cursor-not-allowed aria-disabled:select-none"
                                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                                    data-te-placement="bottom" title="Page">
                                    <div class="font-semibold">
                                        {{ $page }}
                                    </div>
                                </div>
                            </li>
                        @else
                            <li>
                                <a href="{{ $paginator->url($page) }}"
                                    class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100 border-2 border-base-300 rounded-lg transition-colors
                                hover:bg-primary/30 hover:text-base-content/100
                                aria-selected:bg-primary/100 aria-selected:text-primary-content
                                aria-disabled:bg-base-100/50 aria-disabled:text-base-content/50 aria-disabled:cursor-not-allowed aria-disabled:select-none"
                                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                                    data-te-placement="bottom" title="Page">
                                    <div class="font-semibold">
                                        {{ $page }}
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
                <li>
                    @if ($paginator->nextPageUrl())
                        <a href="{{ $paginator->nextPageUrl() }}" aria-details="{{ trans('next') }}"
                            class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100 border-2 border-base-300 rounded-lg transition-colors
                        hover:bg-primary/30 hover:text-base-content/100
                        aria-selected:bg-primary/100 aria-selected:text-primary-content
                        aria-disabled:bg-base-100/50 aria-disabled:text-base-content/50 aria-disabled:cursor-not-allowed aria-disabled:select-none"
                            data-te-toggle="tooltip" data-te-placement="bottom" title="Next">
                            <x-icons.chevron_right class="w-4 h-4" stroke="3">
                            </x-icons.chevron_right>
                        </a>
                    @else
                        <div aria-disabled="true" aria-details="{{ trans('next') }}"
                            class="grid place-items-center w-10 h-10 text-base-content/70 bg-base-100 border-2 border-base-300 rounded-lg transition-colors
                    hover:bg-primary/30 hover:text-base-content/100
                    aria-selected:bg-primary/100 aria-selected:text-primary-content
                    aria-disabled:bg-base-100/50 aria-disabled:text-base-content/50 aria-disabled:cursor-not-allowed aria-disabled:select-none"
                            data-te-toggle="tooltip" data-te-placement="bottom" title="Next">
                            <x-icons.chevron_right class="w-4 h-4" stroke="3">
                            </x-icons.chevron_right>
                        </div>
                    @endif
                </li>
            </ul>
            <div class="flex gap-2 items-center">
                <label for="table_show" class="capitalize">
                    {{ trans('Show') }}:
                </label>
                <select id="table_show" name="perpage"
                    class="text-gray-700 bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize">
                    @php
                        $perpage = $resource->init['perpage'];
                    @endphp
                    @foreach (range(1, 4) as $per)
                        <option @selected($paginator->perPage() == $per * $perpage) value="{{ $per * $perpage }}">
                            {{ $per * $perpage }}
                        </option>
                    @endforeach
                    <option @selected($paginator->perPage() == $paginator->total()) value="{{ $paginator->total() }}">
                        {{ trans('all') }}
                    </option>
                </select>
            </div>
        </nav>
        <div class="flex gap-4 items-center">
            <div>
                <span class="capitalize">{{ trans('showing') }}</span>
                @if ($paginator->onFirstPage())
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ $paginator->firstItem() ?? 0 }}
                    </span>
                    <span> {{ trans('to') }} </span>
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ $paginator->lastItem() ?? 0 }}
                    </span>
                @else
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ $paginator->count() }}
                    </span>
                @endif
                <span>{{ trans('of') }}</span>
                <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span>
                <span>{{ trans('entries') }}</span>.
            </div>
        </div>
    </section>
</div>
