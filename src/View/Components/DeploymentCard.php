<?php

namespace Morethingsdigital\VercelStatamic\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments\VercelDeploymentCreatorDto;
use Morethingsdigital\VercelStatamic\Enums\VercelStates;

class DeploymentCard extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public string $id,
        public string $name,
        public VercelStates $state,
        public string $domain,
        public VercelDeploymentCreatorDto $creator,
        public string $branch,
        public string $repo,
        public string $environment,
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vercel-statamic::components.deployment-card');
    }

    public function url(): string
    {
        return 'https://' . $this->domain;
    }
}
