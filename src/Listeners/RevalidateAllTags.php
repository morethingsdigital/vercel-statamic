<?php

namespace Morethingsdigital\VercelStatamic\Listeners;

use Morethingsdigital\VercelStatamic\Events\PurgeCache;
use Morethingsdigital\VercelStatamic\Services\RevalidationService;
use Morethingsdigital\VercelStatamic\Services\Vercel\DeploymentService;
use Statamic\Facades\CP\Toast;

class RevalidateAllTags
{
  /**
   * Create the event listener.
   */
  public function __construct(private DeploymentService $deploymentService, private RevalidationService $revalidationService)
  {
  }

  /**
   * Handle the event.
   */
  public function handle(PurgeCache $event): void
  {
    if ($this->revalidationService->isEnabled()) {
      $target = config('statamic.vercel.deploy_target');

      $latestDeployment = $this->deploymentService->latestDeploymentByTarget($target);

      if ($latestDeployment) {
        $primaryDomain = array_first($latestDeployment->alias);
        if ($primaryDomain) {
          $invalidatedTags = $this->revalidationService->purgeAll($primaryDomain);

          if (count($invalidatedTags) == count($this->revalidationService->getAllTags())) {
            Toast::success('Purged cache successfully')->duration(5000);
          } else {
            Toast::error('Failed to purge the cache');
          }
        }
      }
    }
  }
}
