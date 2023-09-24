@props(['resource'])

@foreach ($resource->fields as $field)
    @php
        $definition = $resource->model->definition($field);
    @endphp
    <div class="flex flex-col gap-1">
        <div class="text-base font-medium">
            {{ trans($definition->name) }}
        </div>
        <div class="text-base font-medium text-base-content/70">
            @switch($definition->type)
                @case('boolean')
                    {{ $resource->model->{$field} ? trans('true') : trans('false') }}
                @break

                @default
                    @empty($resource->model->{$field})
                        {{ '-' }}
                    @else
                        {{ trans($resource->model->{$field} . '') }}
                    @endempty
            @endswitch
        </div>
    </div>
@endforeach
