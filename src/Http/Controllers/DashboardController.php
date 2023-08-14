<?php

namespace Morethingsdigital\VercelStatamic\Http\Controllers;

use Morethingsdigital\VercelStatamic\Events\PurgeCache;
use Morethingsdigital\VercelStatamic\Services\RevalidationService;
use Statamic\Statamic;

class DashboardController extends Controller
{

    public function __construct(private readonly  RevalidationService $revalidationService)
    {
    }

    public function index()
    {
        return view('vercel-statamic::index', [
            'title' => $this->generateTitle(['Vercel']),
            'latestDeploymentId' => null
        ]);
    }

    public function purgeCache()
    {
        PurgeCache::dispatch();

        return redirect()->route('statamic.cp.vercel-statamic.index');
    }
}
