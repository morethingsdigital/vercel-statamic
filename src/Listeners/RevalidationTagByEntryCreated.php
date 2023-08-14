<?php

namespace Morethingsdigital\VercelStatamic\Listeners;

use Morethingsdigital\VercelStatamic\Services\RevalidationService;
use Morethingsdigital\VercelStatamic\Services\Vercel\DeploymentService;
use Statamic\Events\EntryCreated;

class RevalidationTagByEntryCreated
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
  public function handle(EntryCreated $event): void
  {
    if ($this->revalidationService->isEnabled() && $event->entry->published()) {
      $target = config('statamic.vercel.deploy_target');

      $latestDeployment = $this->deploymentService->latestDeploymentByTarget($target);

      if ($latestDeployment) {
        $primaryDomain = array_first($latestDeployment->alias);
        $tags = $this->revalidationService->generateCollectionTags($event->entry->collection->handle());

        if ($primaryDomain && $tags) {
          foreach ($tags as $tag) {
            $this->revalidationService->create($primaryDomain, $tag);
          }
        }
      }
    }
  }
}
