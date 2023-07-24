<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Icon extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public string $name,
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::components.icon');
    }

}
