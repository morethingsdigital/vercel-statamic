<?php

namespace Morethingsdigital\VercelStatamic\Http\Controllers;

use Morethingsdigital\VercelStatamic\Services\DeploymentService;

class EnvController extends Controller
{


    public function __construct(
        // private readonly DeploymentService $deploymentService
    )
    {
    }

    public function index()
    {
        return view('vercel-statamic::envs.index', [
            'title' => $this->generateTitle(['Vercel', 'Env'])
        ]);
    }
}
