<?php

namespace Morethingsdigital\VercelStatamic\Listeners;

use Morethingsdigital\VercelStatamic\Services\RevalidationService;
use Morethingsdigital\VercelStatamic\Services\Vercel\DeploymentService;
use Statamic\Events\NavDeleted;

class RevalidationTagByNavDeleted
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
  public function handle(NavDeleted $event): void
  {
    if ($this->revalidationService->isEnabled()) {
      $target = config('statamic.vercel.deploy_target');

      $latestDeployment = $this->deploymentService->latestDeploymentByTarget($target);

      if ($latestDeployment) {
        $primaryDomain = array_first($latestDeployment->alias);
        $tags = $this->revalidationService->generateNavigationTags();

        if ($primaryDomain && $tags) {
          foreach ($tags as $tag) {
            $this->revalidationService->create($primaryDomain, $tag);
          }
        }
      }
    }
  }
}
