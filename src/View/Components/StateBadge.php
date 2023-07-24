<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Morethingsdigital\VercelStatamic\Enums\VercelStates;

class StateBadge extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public VercelStates $state,
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::components.state-badge');
    }

    // public function label(): string
    // {
    //     switch ($this->state) {
    //         case 'BUILDING':
    //             return 'BUILDING';
    //         case 'ERROR':
    //             return 'ERROR';
    //         case 'INITIALIZING':
    //             return 'INITIALIZING';
    //         case 'QUEUED':
    //             return 'QUEUED';
    //         case 'READY':
    //             return 'READY';
    //         case 'CANCELED':
    //             return 'CANCELED';
    //     }
    // }

    // public function color(): string
    // {
    //     switch ($this->state) {
    //         case 'BUILDING':
    //             return '#fde047';
    //         case 'ERROR':
    //             return '#ef4444';
    //         case 'INITIALIZING':
    //             return '#2563eb';
    //         case 'QUEUED':
    //             return '#f97316';
    //         case 'READY':
    //             return '#22c55e';
    //         case 'CANCELED':
    //             return '#6b7280';
    //     }
    // }
}
