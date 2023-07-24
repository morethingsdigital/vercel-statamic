<?php

namespace Morethingsdigital\VercelStatamic\Http\Controllers;

use Statamic\Statamic;

class DashboardController extends Controller
{
    public function index()
    {
        return view('vercel-statamic::index', [
            'title' => $this->generateTitle(['Vercel']),
            'latestDeploymentId' => null
        ]);
    }
}
