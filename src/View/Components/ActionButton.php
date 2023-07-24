<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public ?string $icon = null,
        public ?string $label = null,
        public ?string $href = null,
        public ?string $target = null,
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::components.action-button');
    }

    public function tag(): string {
        if($this->href) return 'a';

        return 'button';
    }
}
