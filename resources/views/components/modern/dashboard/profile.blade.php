<div class="flex flex-col gap-4 p-4 bg-base-100 rounded-lg">
    <form id="form" class="flex flex-col gap-x-4 gap-y-8" action="" method="post"
        enctype="multipart/form-data">
        <div>test</div>
        <div class="flex flex-col sm:grid sm:grid-cols-2 gap-x-4 gap-y-8">
            <x-modern.data.form.fields :resource="$resource" :model="$resource->model" />
        </div>
    </form>
</div>
