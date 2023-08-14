<?php

namespace Morethingsdigital\VercelStatamic\Listeners;

use Morethingsdigital\VercelStatamic\Services\RevalidationService;
use Morethingsdigital\VercelStatamic\Services\Vercel\DeploymentService;
use Statamic\Events\GlobalSetDeleted;

class RevalidationTagByGlobalSetDeleted
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
  public function handle(GlobalSetDeleted $event): void
  {
    if ($this->revalidationService->isEnabled()) {
      $target = config('statamic.vercel.deploy_target');

      $latestDeployment = $this->deploymentService->latestDeploymentByTarget($target);

      if ($latestDeployment) {
        $primaryDomain = array_first($latestDeployment->alias);
        $tags = $this->revalidationService->generateGlobalTags();

        if ($primaryDomain && $tags) {
          foreach ($tags as $tag) {
            $this->revalidationService->create($primaryDomain, $tag);
          }
        }
      }
    }
  }
}
