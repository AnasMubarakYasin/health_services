{{-- @aware(['resource']) --}}
@props(['resource', 'menu' => true, 'selection' => true, 'action' => true, 'top' => null, 'actions' => null])

@php
    $resource->resourcing();
    $paginator = $resource->paginator;
    $all = $resource->all;
@endphp

<section class="overflow-auto w-full max-h-[32rem] scroll-smooth">
    <table class="relative w-full h-full border-separate border-spacing-0 pb-1">
        <thead>
            <tr>
                {{-- <th
                        class="block px-2 sticky top-0 left-0 z-[1] bg-base-100 w-full h-full border-t-2 rounded-tl-xl border-l-2 border-base-300">
                    </th> --}}
                @if ($resource->options['selectable'])
                    <th
                        class="p-4 sticky top-0 z-[1] bg-base-100 text-base text-left align-middle font-semibold border border-base-300">
                        <div class="grid place-items-center place-content-center w-full h-full">
                            <input type="checkbox" name="all" id="check_mode" form="delete_any_form"
                                class="appearance-none relative w-5 h-5 bg-base-100 border-2 border-base-300 rounded cursor-pointer !outline-none ring-offset-base-100 transition-all after:transition-all
                            hover:bg-base-200 hover:ring-2 hover:ring-base-300 hover:ring-offset-2 hover:ring-offset-base-100
                            focus:outline-none focus:ring-offset-base-100 focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2
                            checked:!bg-primary checked:ring-2 checked:!ring-primary checked:ring-offset-2 checked:after:w-1/2 checked:after:h-full checked:after:rotate-45 checked:after:scale-[0.7] checked:after:left-[4px] checked:after:bottom-[1.5px] checked:after:border-r-4 checked:after:border-b-4
                            indeterminate:!bg-primary indeterminate:ring-2 indeterminate:ring-primary indeterminate:ring-offset-2
                            after:content-[''] after:absolute after:bg-transparent after:border-primary-content
                            indeterminate:after:w-0 indeterminate:after:h-full indeterminate:after:bg-transparent indeterminate:after:rotate-90 indeterminate:after:border-r-4 indeterminate:after:border-b-4 indeterminate:after:border-primary-content indeterminate:after:left-[6px] indeterminate:after:bottom-0 indeterminate:after:scale-[0.55]">
                        </div>
                    </th>
                @endif

                <th data-iteration="true"
                    class="p-4 sticky top-0 left-0 z-[2] bg-base-100 text-base text-center align-middle font-semibold border border-base-300 capitalize">
                    {{ trans('#') }}
                </th>
                @foreach ($resource->columns as $column)
                    <th class="p-4 sticky top-0 left-10 z-[1] bg-base-100 text-base text-left align-middle font-semibold border border-base-300 hover:bg-base-200 cursor-pointer transition-colors"
                        data-col="true" data-col_index="{{ $loop->index }}">
                        <div class="flex justify-between items-center">
                            <div class="whitespace-nowrap">
                                {{ trans($resource->model->definition($column)->name) }}
                            </div>
                            @if ($resource->options['sortable'])
                                @if (request()->query('sort_name') == $column)
                                    @if (request()->query('sort_dir', 'desc') == 'desc')
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'on', 'sort_name' => $column, 'sort_dir' => 'asc']) }}"
                                            role="button"
                                            class="grid place-items-center w-8 h-8 text-base-content/70 hover:bg-primary hover:text-primary-content/100 rounded sm:rounded-lg transition-colors
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
                                            class="grid place-items-center w-8 h-8 text-base-content/70 hover:bg-primary hover:text-primary-content/100 rounded sm:rounded-lg transition-colors
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
                                @else
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'on', 'sort_name' => $column, 'sort_dir' => 'desc']) }}"
                                        role="button"
                                        class="grid place-items-center w-8 h-8 text-base-content/70 hover:bg-primary hover:text-primary-content/100 rounded sm:rounded-lg transition-colors
                                group-[#topbar&[data-button-interface='filled']]:bg-primary/30
                                group-[#topbar&[data-button-interface='filled']]:hover:bg-primary/50
                                group-[#topbar&[data-button-interface='outlined']]:border-2
                                group-[#topbar&[data-button-interface='outlined']]:border-primary
                                group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                        data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                        data-te-placement="bottom" title="Sort">
                                        <x-icons.chevron_up_down class=" w-5 h-5" stroke="2" />
                                    </a>
                                @endif
                            @endif
                        </div>
                    </th>
                @endforeach
                @if ($resource->options['action'])
                    <th id="action" data-action="true"
                        class="p-4 sticky top-0 right-0 z-[1] bg-base-100 text-base text-center align-middle font-semibold border border-base-300 hover:bg-base-200 cursor-pointer">
                        Action
                    </th>
                @endif
                {{-- <th class="block px-2 sticky top-0 right-0 z-[1] bg-base-100 w-2 h-full border-t-2 rounded-tr-xl border-r-2 border-base-300">
                    </th> --}}
            </tr>
        </thead>
        <tbody>
            @if ($resource->options['filter_by_column'])
                <tr>
                    {{-- <th class="block px-2 bg-base-100 w-full h-full border-l-2 border-t-2 border-base-300"></th> --}}
                    <th
                        class="p-2 pl-0 bg-base-100 text-base text-center align-middle font-semibold border border-base-300">
                    </th>
                    <th
                        class="p-2 sticky left-0 bg-base-100 text-base text-center align-middle font-semibold border border-base-300 z-[1]">
                    </th>
                    @forelse ($resource->columns as $column)
                        <th
                            class="p-2 bg-base-100 text-base text-left align-middle font-semibold border border-base-300">
                            <form action="{{ request()->fullUrlWithQuery([]) }}" autocomplete="off"
                                class="relative border-none">
                                <input type="hidden" name="filter" value="on">
                                <input type="text" name="filter_{{ $column }}"
                                    value="{{ request()->query("filter_$column") }}"
                                    class="w-full pr-9 pl-2 py-2 truncate text-ellipsis bg-base-100 text-sm border-2 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
                                <button
                                    class="grid place-items-center w-8 h-8 !absolute top-1 right-1 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg transition-colors
                                    group-[#topbar&[data-button-interface='filled']]:bg-primary/30
                                    group-[#topbar&[data-button-interface='filled']]:hover:bg-primary/50
                                    group-[#topbar&[data-button-interface='outlined']]:border-2
                                    group-[#topbar&[data-button-interface='outlined']]:border-primary
                                    group-[#topbar&[data-button-shape='circled']]:rounded-full"
                                    data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                    data-te-placement="bottom" title="Search">
                                    <x-icons.search class=" w-5 h-5" stroke="2"></x-icons.search>
                                </button>
                            </form>
                        </th>
                    @endforeach
                    @if ($resource->options['action'])
                        <th data-action="true"
                            class="p-2 sticky right-0 bg-base-100 text-base text-left align-middle font-semibold border border-base-300">
                        </th>
                    @endif
                    {{-- <th class="block px-2 bg-base-100 w-2 h-full border-r-2 border-t-2 border-base-300"></th> --}}
                </tr>
            @endif
            @forelse($paginator ?? $all as $item)
                <tr>
                    {{-- <td class="block px-2 bg-base-100 w-full h-full border-l-2 border-t-2 border-base-300"></td> --}}
                    @if ($resource->options['selectable'])
                        <th
                            class="p-4 bg-base-100 text-base text-center align-middle font-semibold border border-base-300">
                            <div class="grid place-items-center place-content-center w-full h-full">
                                <input type="checkbox" name="id[]" id="" form="delete_any_form"
                                    value="{{ $item->id }}"
                                    class="check_item appearance-none relative w-5 h-5 bg-base-100 border-2 border-base-300 rounded cursor-pointer !outline-none ring-offset-base-100 transition-all after:transition-all
                                    hover:bg-base-200 hover:ring-2 hover:ring-base-300 hover:ring-offset-2 hover:ring-offset-base-100
                                    focus:outline-none focus:ring-offset-base-100 focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2
                                    checked:!bg-primary checked:ring-2 checked:!ring-primary checked:ring-offset-2 checked:after:w-1/2 checked:after:h-full checked:after:rotate-45 checked:after:scale-[0.7] checked:after:left-[4px] checked:after:bottom-[1.5px] checked:after:border-r-4 checked:after:border-b-4
                                    indeterminate:!bg-primary indeterminate:ring-2 indeterminate:ring-primary indeterminate:ring-offset-2
                                    after:content-[''] after:absolute after:bg-transparent after:border-primary-content
                                    indeterminate:after:w-0 indeterminate:after:h-full indeterminate:after:bg-transparent indeterminate:after:rotate-90 indeterminate:after:border-r-4 indeterminate:after:border-b-4 indeterminate:after:border-primary-content indeterminate:after:left-[6px] indeterminate:after:bottom-0 indeterminate:after:scale-[0.55]">
                            </div>
                        </th>
                    @endif

                    <th class="p-4 sticky left-0 bg-base-100 text-base text-center align-middle font-semibold border border-base-300 hover:bg-base-200 cursor-pointer transition-colors"
                        data-row="true">
                        @if ($paginator)
                            {{ $paginator->perPage() * $paginator->currentPage() + $loop->iteration - $paginator->perPage() }}
                        @else
                            {{ $loop->iteration }}
                        @endif
                    </th>
                    @foreach ($resource->columns as $column)
                        @switch($resource->model->definition($column)->type)
                            @case('boolean')
                                <td class="p-4 bg-base-100 text-base text-left whitespace-nowrap align-middle font-normal border border-base-300 transition-colors"
                                    data-col_index="{{ $loop->index }}">
                                    @if (is_null($item->{$column}))
                                    @else
                                        {{ $item->{$column} ? trans('true') : trans('false') }}
                                    @endif
                                </td>
                            @break

                            @case('model')
                                @if ($resource->model->definition($column)->array)
                                    <td
                                        class="p-4 bg-base-100 text-base text-left whitespace-nowrap align-middle font-normal border border-base-300 transition-colors">
                                        @php
                                            $query = $item->{$column}->reduce(function ($result, $item, $index) {
                                                $result .= '&id[]=' . $item->id;
                                                return $result;
                                            }, '?ref=on');
                                        @endphp
                                        <a href="{{ $resource->route_relation($resource->model->definition($column), $item->{$column}) . $query }}"
                                            class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                            {{ count($item->{$column}) }}
                                            {{ $resource->model->definition($column)->name }}
                                        </a>
                                    </td>
                                @else
                                    @if ($resource->options['reference'] == 'on')
                                        <td
                                            class="p-4 bg-base-100 text-base text-left whitespace-nowrap align-middle font-normal border border-base-300 transition-colors">
                                            @php
                                                $query = '?ref=on&id[]=' . $item->{$column}->id;
                                            @endphp
                                            <a href="{{ $resource->route_relation($resource->model->definition($column), $item->{$column}) . $query }}"
                                                class="bg-base-300 text-base-content text-base font-medium px-3 py-1 rounded">
                                                {{-- {{ $resource->model->definition($column)->name }} --}}
                                                {{ $item->{$column}->name }}
                                            </a>
                                        </td>
                                    @else
                                        <td
                                            class="p-4 bg-base-100 text-base text-left whitespace-nowrap align-middle font-normal border border-base-300 transition-colors">
                                            {{ $item->{$column}->name }}
                                        </td>
                                    @endif
                                @endif
                            @break

                            @default
                                <td class="p-4 bg-base-100 text-base text-left whitespace-nowrap align-middle font-normal border border-base-300 transition-colors"
                                    data-col_index="{{ $loop->index }}">
                                    @if (is_array($item->{$column}))
                                        {{ implode(', ', $item->{$column}) }}
                                    @else
                                    @empty($item->{$column})
                                        {{ '-' }}
                                    @else
                                        {{ trans($item->{$column} . '') }}
                                    @endempty
                                @endif
                            </td>
                    @endswitch
                @endforeach
                @if ($resource->options['action'])
                    <td data-action="true"
                        class="p-4 sticky right-0 bg-base-100 text-base text-left align-middle font-normal border border-base-300">
                        <div data-te-dropdown-ref data-te-dropdown-position="dropstart"
                            class="relative flex sm:hidden justify-center items-center gap-2 w-full">
                            <button data-te-dropdown-toggle-ref
                                class="grid place-items-center w-10 h-10 bg-info/90 text-info-content/90 rounded-lg transition-colors
                             hover:bg-info/100 hover:text-info-content/100"
                                data-te-ripple-init data-te-ripple-color="ligth">
                                <x-icons.ellipsis_vertical class="w-6 h-6" stroke="2">
                                </x-icons.ellipsis_vertical>
                            </button>
                            <ul class="absolute z-20 float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                                data-te-dropdown-menu-ref>
                                <li>
                                    <button
                                        class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        data-te-dropdown-item-ref data-te-toggle="modal"
                                        data-te-target="#view_modal_{{ $loop->index }}">
                                        Show
                                    </button>
                                </li>
                                <li>
                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        href="{{ $resource->web_update($item) }}" data-te-dropdown-item-ref>
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <button data-te-toggle="modal"
                                        data-te-target="#delete_modal_{{ $loop->index }}"
                                        class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        data-te-dropdown-item-ref>
                                        Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="hidden sm:flex justify-center items-center gap-2 w-full">
                            <div data-te-toggle="tooltip" data-te-placement="bottom" title="Show">
                                <button
                                    class="grid place-items-center w-10 h-10 bg-success/90 text-success-content/90 rounded-lg transition-colors
                             hover:bg-success/100 hover:text-success-content/100"
                                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="modal"
                                    data-te-target="#view_modal_{{ $loop->index }}">
                                    <x-icons.eye_on class="w-6 h-6" stroke="2">
                                    </x-icons.eye_on>
                                </button>
                            </div>
                            <a href="{{ $resource->web_update($item) }}"
                                class="grid place-items-center w-10 h-10 bg-info/90 text-info-content/90 rounded-lg transition-colors
                                 hover:bg-info/100 hover:text-info-content/100"
                                data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                                data-te-placement="bottom" title="Edit">
                                <x-icons.edit class="w-6 h-6" stroke="2">
                                </x-icons.edit>
                            </a>
                            <div data-te-toggle="tooltip" data-te-placement="bottom" title="Delete">
                                <button
                                    class="grid place-items-center w-10 h-10 bg-danger/90 text-danger-content/90 rounded-lg transition-colors
                                 hover:bg-danger/100 hover:text-danger-content/100"
                                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="modal"
                                    data-te-target="#delete_modal_{{ $loop->index }}">
                                    <x-icons.delete class="w-6 h-6" stroke="2">
                                    </x-icons.delete>
                                </button>
                            </div>
                        </div>
                    </td>
                @endif
                {{-- <td class="block px-2 bg-base-100 w-2 h-full border-r-2 border-t-2 border-base-300"></td> --}}
            </tr>
            @empty
                <tr>
                    {{-- <td class="block px-2 bg-base-100 w-full h-full border-l-2 border-b-2 border-base-300">
                        </td> --}}
                    {{-- <td class="bg-base-100 border-b-2 border-base-300"></td> --}}
                    {{-- <td class="bg-base-100 border-b-2 border-base-300"></td> --}}
                    <td colspan="{{ count($resource->columns) + 4 }}"
                        class="px-4 py-4 text-base-content/60 bg-base-100 text-base text-center whitespace-nowrap align-middle font-medium border border-base-300 transition-colors">
                        Empty
                    </td>
                    {{-- <td class="bg-base-100 border-b-2 border-base-300"></td> --}}
                    {{-- <td class="block px-2 bg-base-100 w-2 h-full border-r-2 border-b-2 border-base-300"> --}}
                    </td>
                </tr>
            @endforelse
        </tbody>
        {{-- <tfoot>
                <tr>
                    @if (empty($paginator ?? $all))
                        <th
                            class="block min-w-[4px] w-full h-4 px-2 bg-base-100 border-b-2 rounded-bl-xl border-l-2 border-base-300">
                        </th>
                        <th class="px-2 bg-base-100 h-4 border-b-2 border-base-300"></th>
                        <th class="px-2 sticky left-0 bg-base-100 h-4 border-b-2 border-l-2 border-base-300"></th>
                        @foreach ($resource->columns as $column)
                            <th class="px-2 bg-base-100 h-4 border-b-2 border-l-2 border-base-300"></th>
                        @endforeach
                        <th class="px-2 sticky right-0 bg-base-100 h-4 border-b-2 border-l-2 border-base-300"></th>
                        <th class="block w-2 h-4 px-2 bg-base-100 border-b-2 rounded-br-xl border-r-2 border-base-300">
                        </th>
                    @else
                        <th
                            class="block min-w-[4px] w-full h-4 px-2 bg-base-100 border-b-2 rounded-bl-xl border-l-2 border-base-300">
                        </th>
                        <th class="px-2 bg-base-100 h-4 border-b-2 border-base-300"></th>
                        <th class="px-2 sticky left-0 bg-base-100 h-4 border-b-2 border-base-300"></th>
                        @foreach ($resource->columns as $column)
                            <th class="px-2 bg-base-100 h-4 border-b-2 border-base-300"></th>
                        @endforeach
                        <th class="px-2 sticky right-0 bg-base-100 h-4 border-b-2 border-base-300"></th>
                        <th class="block w-2 h-4 px-2 bg-base-100 border-b-2 rounded-br-xl border-r-2 border-base-300">
                        </th>
                    @endif
                </tr>
            </tfoot> --}}
    </table>

</section>

<section class="contents">
    <div data-te-modal-init
        class="fixed left-0 top-0 z-[1050] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
        id="delete_modal" tabindex="-1" aria-labelledby="delete_modal_label" aria-hidden="true">
        <div data-te-modal-dialog-ref
            class="max-w-xl max-sm:w-auto mx-auto mt-8 max-sm:m-4  transition-all duration-300 ease-in-out">
            <div
                class="pointer-events-auto flex w-full flex-col bg-base-100 bg-clip-padding text-base-content rounded-md border-none shadow-lg outline-none">
                <div class="flex items-center justify-between px-4 py-2 rounded-t-md border-b-2 border-base-300">
                    <div class="text-xl font-medium text-base-content" id="delete_modal_label">
                        Delete Selected Data
                    </div>
                    <button
                        class="grid place-items-center p-2 bg-base-200 text-base-content rounded-md transition-colors hover:bg-base-300"
                        data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                        data-te-placement="bottom" title="Close" data-te-modal-dismiss>
                        <x-icons.close class="w-5 h-5" stroke="2.5">
                        </x-icons.close>
                    </button>
                </div>
                <div class="flex-auto p-4" data-te-modal-body-ref>
                    Are you sure you want to delete selected data?
                </div>
                <div
                    class="flex flex-wrap items-center justify-end gap-4 px-4 py-2 rounded-b-md border-t-2 border-base-300">
                    <button
                        class="grid place-items-center px-8 py-2 bg-base-200 text-base-content text-sm font-medium rounded-md transition-colors hover:bg-base-300"
                        data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                        Cancel
                    </button>
                    <form id="delete_any_form" action="{{ $resource->api_delete_any() }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button
                            class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-sm font-medium rounded-md transition-colors hover:bg-primary-focus"
                            data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                            Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @forelse($paginator ?? $all as $item)
        <div data-te-modal-init
            class="fixed left-0 top-0 z-[1050] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            id="view_modal_{{ $loop->index }}" tabindex="-1"
            aria-labelledby="view_modal_{{ $loop->index }}_label" aria-hidden="true">
            <div data-te-modal-dialog-ref
                class="max-w-xl max-sm:w-auto mx-auto mt-8 max-sm:m-4  transition-all duration-300 ease-in-out">
                <div
                    class="pointer-events-auto flex w-full flex-col bg-base-100 bg-clip-padding text-base-content rounded-md border-none shadow-lg outline-none">
                    <div class="flex items-center justify-between px-4 py-2 rounded-t-md border-b-2 border-base-300">
                        <div class="text-xl font-medium text-base-content" id="view_modal_{{ $loop->index }}_label">
                            View Data #{{ $loop->iteration }}
                        </div>
                        <button
                            class="grid place-items-center p-2 bg-base-200 text-base-content rounded-md transition-colors hover:bg-base-300"
                            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                            data-te-placement="bottom" title="Close" data-te-modal-dismiss>
                            <x-icons.close class="w-5 h-5" stroke="2.5">
                            </x-icons.close>
                        </button>
                    </div>
                    <div class="flex-auto flex flex-col gap-4 p-4 overflow-y-auto" data-te-modal-body-ref>
                        @foreach ($resource->columns as $column)
                            <div class="flex flex-col gap-1">
                                <div class="text-lg font-semibold">
                                    {{ trans($resource->model->definition($column)->name) }}</div>
                                <div class="text-base font-medium">{{ $item->{$column} }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div
                        class="flex flex-wrap items-center justify-end gap-4 px-4 py-2 rounded-b-md border-t-2 border-base-300">
                        <a href="{{ $resource->web_update($item) }}"
                            class="grid place-items-center px-8 py-2 bg-info/70 text-info-content/90 text-sm font-medium rounded-md transition-colors hover:bg-info/100 hover:text-info-content/100"
                            data-te-ripple-init data-te-ripple-color="ligth">
                            Edit
                        </a>
                        <button
                            class="grid place-items-center px-8 py-2 bg-danger/70 text-danger-content/90 text-sm font-medium rounded-md transition-colors hover:bg-danger/100 hover:text-danger-content/100"
                            data-te-toggle="modal" data-te-target="#delete_modal_{{ $loop->index }}"
                            data-te-ripple-init data-te-ripple-color="ligth">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div data-te-modal-init
            class="fixed left-0 top-0 z-[1060] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            id="delete_modal_{{ $loop->index }}" tabindex="-1"
            aria-labelledby="delete_modal_{{ $loop->index }}_label" aria-hidden="true">
            <div data-te-modal-dialog-ref
                class="max-w-xl max-sm:w-auto mx-auto mt-8 max-sm:m-4  transition-all duration-300 ease-in-out">
                <div
                    class="pointer-events-auto flex w-full flex-col bg-base-100 bg-clip-padding text-base-content rounded-md border-none shadow-lg outline-none">
                    <div class="flex items-center justify-between px-4 py-2 rounded-t-md border-b-2 border-base-300">
                        <div class="text-xl font-medium text-base-content"
                            id="delete_modal_{{ $loop->index }}_label">
                            Delete Data
                        </div>
                        <button
                            class="grid place-items-center p-2 bg-base-200 text-base-content rounded-md transition-colors hover:bg-base-300"
                            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip"
                            data-te-placement="bottom" title="Close" data-te-modal-dismiss>
                            <x-icons.close class="w-5 h-5" stroke="2.5">
                            </x-icons.close>
                        </button>
                    </div>
                    <div class="flex-auto p-4" data-te-modal-body-ref>
                        Are you sure you want to delete data?
                    </div>
                    <div
                        class="flex flex-wrap items-center justify-end gap-4 px-4 py-2 rounded-b-md border-t-2 border-base-300">
                        <button
                            class="grid place-items-center px-8 py-2 bg-base-200 text-base-content text-sm font-medium rounded-md transition-colors hover:bg-base-300"
                            data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                            Cancel
                        </button>
                        <form action="{{ $resource->api_delete($item) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button
                                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-sm font-medium rounded-md transition-colors hover:bg-primary-focus"
                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                                Yes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>
