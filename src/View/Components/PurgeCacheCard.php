<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PurgeCacheCard extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct()
    {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::components.purge-cache-card');
    }
}
