<?php

namespace Rahweb\CmsCore\View\Components;

use Illuminate\View\Component;

class CkEditor extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name,
        public string $label,
        public string $type,
        public $valueData = null,
        public array $validations = [],
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('CmsCore::components.forms.ck-editor');
    }
}
