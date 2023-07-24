<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class AppLayout extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public bool $hasBreadcrumb = false,
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::layouts.app');
    }
}
