@props(['tables'])
{{-- @dd($tables) --}}

<div class="@container grid gap-4">
    <div class="flex gap-4">
        <a href="{{ route('web.administrator.database.download') }}"
            class="grid place-items-center w-10 h-10 bg-primary text-primary-content rounded-lg transition-colors
        hover:bg-primary-focus"
            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip" data-te-placement="bottom"
            title="Download">
            <x-icons.download class="w-6 h-6" stroke="2">
            </x-icons.download>
        </a>
        <button
            class="grid place-items-center w-10 h-10 bg-primary text-primary-content rounded-lg transition-colors
    hover:bg-primary-focus"
            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="modal" data-te-target="#upload_modal">
            <x-icons.upload class="w-6 h-6" stroke="2">
            </x-icons.upload>
        </button>
    </div>
    <div
        class="hidden @xl:grid grid-cols-12 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content rounded-lg shadow-all-lg">
        <div class="font-bold capitalize col-span-1">
            {{ trans('#') }}
        </div>
        <div class="font-bold capitalize col-span-3">
            {{ trans('name') }}
        </div>
        <div class="font-bold capitalize col-span-3">
            {{ trans('pkey') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('fkeys') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('indexes') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('uniques') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('cols') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('rows') }}
        </div>
    </div>

    @foreach ($tables as $table)
        <button class=""
            onclick="location.assign('{{ route('web.administrator.table', ['table' => $loop->index]) }}')">
            <div
                class="hidden @xl:grid grid-cols-12 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content hover:bg-base-200 rounded-lg shadow-all-lg">
                <div class="col-start-1 col-end-2">
                    {{ $loop->iteration }}
                </div>
                <div class="col-start-2 col-end-5">
                    {{ $table->getName() }}
                </div>
                <div class="col-start-5 col-end-8">
                    {{ $table->getPrimaryKey()->getName() }}
                </div>
                <div class="font-medium col-span-1">
                    {{ count($table->getForeignKeys()) }}
                </div>
                <div class="font-medium col-span-1">
                    {{ count($table->getIndexes()) }}
                </div>
                <div class="font-medium col-span-1">
                    {{ count($table->getUniqueConstraints()) }}
                </div>
                <div class="font-medium col-span-1">
                    {{ count($table->getColumns()) }}
                </div>
                <div class="font-medium col-span-1">
                    {{ DB::table($table->getName())->count() }}
                </div>
            </div>
        </button>
    @endforeach
</div>

<div data-te-modal-init
    class="fixed left-0 top-0 z-[1050] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="upload_modal" tabindex="-1" aria-labelledby="upload_modal_label" aria-hidden="true">
    <div data-te-modal-dialog-ref
        class="max-w-xl max-sm:w-auto mx-auto mt-8 max-sm:m-4  transition-all duration-300 ease-in-out">
        <div
            class="pointer-events-auto flex w-full flex-col bg-base-100 bg-clip-padding text-base-content rounded-md border-none shadow-lg outline-none">
            <div class="flex items-center justify-between px-4 py-2 rounded-t-md border-b-2 border-base-300">
                <div class="text-xl font-medium text-base-content" id="upload_modal_label">
                    Upload Database
                </div>
                <button
                    class="grid place-items-center p-2 bg-base-200 text-base-content rounded-md transition-colors hover:bg-base-300"
                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip" data-te-placement="bottom"
                    title="Close" data-te-modal-dismiss>
                    <x-icons.close class="w-5 h-5" stroke="2.5">
                    </x-icons.close>
                </button>
            </div>
            <div class="flex-auto p-4" data-te-modal-body-ref>
                <form id="upload_form" action="{{ route('web.administrator.database.upload') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="database">
                </form>
            </div>
            <div
                class="flex flex-wrap items-center justify-end gap-4 px-4 py-2 rounded-b-md border-t-2 border-base-300">
                <button
                    class="grid place-items-center px-8 py-2 bg-base-200 text-base-content text-sm font-medium rounded-md transition-colors hover:bg-base-300"
                    data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                    Cancel
                </button>
                <button form="upload_form"
                    class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-sm font-medium rounded-md transition-colors hover:bg-primary-focus"
                    data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>
