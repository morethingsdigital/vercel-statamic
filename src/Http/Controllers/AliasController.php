<?php

namespace Morethingsdigital\VercelStatamic\Http\Controllers;

use Morethingsdigital\VercelStatamic\Services\DeploymentService;

class AliasController extends Controller
{


    public function __construct(
        // private readonly DeploymentService $deploymentService
    )
    {
    }

    public function index()
    {

        return view('vercel-statamic::aliase.index', [
            'title' => $this->generateTitle(['Vercel', 'Aliase'])
        ]);
    }
}
