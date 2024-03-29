@props([
    'fields' => [],
])
<div class="grid gap-4 p-4">
    <form
        class="grid gap-4 p-4 px-5 lg:w-1/2 text-gray-700 border border-gray-200 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700"
        action="{{ $resource->is_create() ? $resource->api_create() : $resource->api_update($model) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @if ($resource->is_update())
            @method('PATCH')
        @endif
        <input type="hidden" name="_view_any" value="{{ $resource->web_view_any() }}">
        <div class="grid grid-flow-row gap-4">
            @include('components.simple.resource.fields', [
                'fields' => $resource->fields,
                'resource' => $resource,
                'model' => $model,
            ])
        </div>
        <div class="grid place-items-center">
            <button
                class="w-full sm:w-1/2 lg:w-1/4 capitalize text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __($resource->mode) }}
            </button>
        </div>
        @env('local')
        @forelse ($errors->all() as $error)
            <div class="text-black dark:text-white">{{ $error }}</div>
        @empty
        @endforelse
        @endenv
    </form>
</div>
