<?php

namespace Morethingsdigital\VercelStatamic\Http\Controllers;

use Morethingsdigital\VercelStatamic\Services\DeploymentService;

class Controller
{


    public function generateTitle(array $values): string
    {
        return implode(' › ', $values);
    }
}
