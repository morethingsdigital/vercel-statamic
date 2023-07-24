<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeployButton extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public string $id,
        public ?string $label = 'Deploy now!'
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::components.deploy-button');
    }
}
