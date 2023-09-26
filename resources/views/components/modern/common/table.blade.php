@props(['table'])
{{-- @dd($table) --}}

<div class="@container grid gap-4">
    <div
        class="hidden @xl:grid grid-cols-12 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content rounded-lg shadow-all-lg">
        <div class="font-bold capitalize col-span-1">
            {{ trans('#') }}
        </div>
        <div class="font-bold capitalize col-span-3">
            {{ trans('name') }}
        </div>
        <div class="font-bold capitalize col-span-2">
            {{ trans('type') }}
        </div>
        <div class="font-bold capitalize col-span-2">
            {{ trans('length') }}
        </div>
        <div class="font-bold capitalize col-span-2">
            {{ trans('not null') }}
        </div>
        <div class="font-bold capitalize col-span-2">
            {{ trans('default') }}
        </div>
    </div>

    @foreach ($table->getColumns() as $column)
        <button class="">
            <div
                class="hidden @xl:grid grid-cols-12 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content hover:bg-base-200 rounded-lg shadow-all-lg">
                <div class="col-span-1">
                    {{ $loop->iteration }}
                </div>
                <div class="col-span-3">
                    {{ $column->getName() }}
                </div>
                <div class="col-span-2">
                    {{ $column->getType()->getName() }}
                </div>
                <div class="col-span-2">
                    {{ $column->getLength() }}
                </div>
                <div class="col-span-2">
                    {{ $column->getNotnull() ? 'true' : 'false' }}
                </div>
                <div class="col-span-2">
                    @if (is_bool($column->getDefault()))
                        {{ $column->getDefault() ? 'true' : 'false' }}
                    @else
                        {{ $column->getDefault() }}
                    @endif
                </div>
            </div>
        </button>
    @endforeach
</div>
