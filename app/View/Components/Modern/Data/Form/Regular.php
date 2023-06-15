<?php

namespace App\View\Components\Modern\Data\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Dynamic\Resource\Form as ResourceForm;

class Regular extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ResourceForm $resource)
    {
        $resource->resourcing();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modern.data.form.regular', [
            'model' => $this->resource->model,
        ]);
    }
}
