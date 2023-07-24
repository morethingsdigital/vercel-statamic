<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Avatar extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $email = null,
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::components.avatar');
    }

    public function initials(): string
    {
        return Str::upper(Str::substr($this->name, 0, 1));
    }
}
