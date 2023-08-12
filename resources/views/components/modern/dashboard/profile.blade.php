@aware([
    'user' => null,
    'panel' => null,
])
<div class="flex flex-col gap-4 p-4 bg-base-100 rounded-lg">
    <form id="form" class="flex flex-col gap-x-4 gap-y-8" action="{{ $panel->change_profile() }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="font-semibold text-xl text-base-content/70 text-center capitalize">{{ trans('profile') }}</div>
        <div class="flex flex-col sm:grid sm:grid-cols-2 gap-x-4 gap-y-8">
            <x-modern.data.form.fields :resource="$resource" :model="$resource->model" />
        </div>
        <div class="col-span-2 flex justify-center">
            <button
                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                {{ trans($resource->mode) }}
            </button>
        </div>
    </form>
</div>
