<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public ?int $currentPage = 1,
        public ?int $nextPage = null,
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::components.pagination');
    }
}
