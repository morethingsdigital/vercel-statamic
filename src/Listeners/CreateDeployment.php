<?php

namespace Morethingsdigital\VercelStatamic\Listeners;

use Illuminate\Support\Facades\Log;
use Morethingsdigital\VercelStatamic\Dtos\Deployments\CreateDeploymentDto;
use Morethingsdigital\VercelStatamic\Services\DeploymentService;
use Statamic\Events\EntrySaved;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Nette\NotImplementedException;
use Statamic\Events\EntryDeleted;
use Statamic\Events\GlobalSetSaved;

class CreateDeployment
{
  /**
   * Create the event listener.
   */
  public function __construct(private DeploymentService $deploymentService)
  {
  }

  /**
   * Handle the event.
   */
  public function handle(EntrySaved|EntryDeleted|GlobalSetSaved $event): void
  {
    $className = get_class($event);

    switch ($className) {
      case 'Statamic\Events\EntrySaved':
        $this->handleRedeployOnEntrySaved($event);
        break;

      case 'Statamic\Events\EntryDeleted':
        $this->handleRedeployOnEntryDeleted($event);
        break;

      case 'Statamic\Events\GlobalSetSaved':
        $this->handleRedeployOnGlobalSetSaved($event);
        break;
    }
  }


  private function handleRedeployOnEntrySaved(EntrySaved $event)
  {
    try {

      $entry = $event->entry;

      $latestDeployment = $this->deploymentService->latestDeployment();

      if (!$latestDeployment) throw new HttpException(Response::HTTP_NOT_FOUND, 'no deployment found');

      $createDeploymentDto = new CreateDeploymentDto($latestDeployment->name, $latestDeployment->id);

      $deploymentDto = $this->deploymentService->redeploy($createDeploymentDto, true);

      if (!$deploymentDto) throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, 'deployment cound not be triggert');

      Log::info('Deployment ' . $deploymentDto->name . ' has status ' . $deploymentDto->state->label() . ' after triggert by saved event of entry ' . $entry->slug());
    } catch (HttpException $exception) {
      throw new HttpException($exception->getStatusCode(), $exception->getMessage());
    } catch (\Exception $exception) {
      throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
    }
  }

  private function handleRedeployOnEntryDeleted(EntryDeleted $event)
  {
    try {

      throw new NotImplementedException();


      // $entry = $event->entry;

      // $latestDeployment = $this->deploymentService->latestDeployment();

      // if (!$latestDeployment) throw new HttpException(Response::HTTP_NOT_FOUND, 'no deployment found');

      // $createDeploymentDto = new CreateDeploymentDto($latestDeployment->name, $latestDeployment->id);

      // $deploymentDto = $this->deploymentService->redeploy($createDeploymentDto, true);

      // if (!$deploymentDto) throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, 'deployment cound not be triggert');

      // Log::info('Deployment ' . $deploymentDto->name . ' has status ' . $deploymentDto->state->label() . ' after triggert by saved event of entry ' . $entry->slug());
    } catch (HttpException $exception) {
      throw new HttpException($exception->getStatusCode(), $exception->getMessage());
    } catch (\Exception $exception) {
      throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
    }
  }

  private function handleRedeployOnGlobalSetSaved(GlobalSetSaved $event)
  {
    try {
      throw new NotImplementedException();

      // $entry = $event->entry;

      // $latestDeployment = $this->deploymentService->latestDeployment();

      // if (!$latestDeployment) throw new HttpException(Response::HTTP_NOT_FOUND, 'no deployment found');

      // $createDeploymentDto = new CreateDeploymentDto($latestDeployment->name, $latestDeployment->id);

      // $deploymentDto = $this->deploymentService->redeploy($createDeploymentDto, true);

      // if (!$deploymentDto) throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, 'deployment cound not be triggert');

      // Log::info('Deployment ' . $deploymentDto->name . ' has status ' . $deploymentDto->state->label() . ' after triggert by saved event of entry ' . $entry->slug());
    } catch (HttpException $exception) {
      throw new HttpException($exception->getStatusCode(), $exception->getMessage());
    } catch (\Exception $exception) {
      throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
    }
  }
}
