<?php

namespace Morethingsdigital\VercelStatamic\Services\Vercel;

use Illuminate\Support\Facades\Log;
use Morethingsdigital\VercelStatamic\Dtos\Deployments\CreateDeploymentDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Common\VercelPaginationDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments\VercelDeploymentCreatorDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments\VercelDeploymentDeleteDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments\VercelDeploymentDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments\VercelDeploymentMetaDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments\VercelDeploymentsResult;
use Morethingsdigital\VercelStatamic\Enums\VercelStates;
use Morethingsdigital\VercelStatamic\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeploymentService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cancel(string $id): VercelDeploymentDto
    {
        try {
            $response = $this->patch(url: '/v12/deployments/' . $id . '/cancel');

            if (!$response->successful()) throw new HttpException($response->status(), $this->extractErrorMessageFromResponse($response));

            $data = $response->json();

            return new VercelDeploymentDto($data['id'], $data['name'], $data['url'], $data['state'], VercelDeploymentCreatorDto::from($data['creator']), VercelDeploymentMetaDto::from($data['meta']));
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }
    }

    public function redeploy(CreateDeploymentDto $createDeploymentDto, bool $forceNew = false, bool $skipAutoDetectionConfirmation = false): VercelDeploymentDto
    {
        try {
            $response = $this->post(url: '/v13/deployments', body: $createDeploymentDto->toArray(), query: [
                'forceNew' => $forceNew == false ? 0 : 1,
                'skipAutoDetectionConfirmation' => $skipAutoDetectionConfirmation == false ? 0 : 1,
            ]);

            if (!$response->successful()) throw new HttpException($response->status(), $this->extractErrorMessageFromResponse($response));

            $data = $response->json();

            $data = $this->mapVercelKeyDifferents($data);

            return new VercelDeploymentDto($data['id'], $data['name'], $data['url'], $data['state'], VercelDeploymentCreatorDto::from($data['creator']), VercelDeploymentMetaDto::from($data['meta']));
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }
    }

    public function find(string $projectId, int $limit = 10, array $states = [], string $target = null, int $from = null, int $since = null): VercelDeploymentsResult
    {
        try {
            $response = $this->get(url: '/v6/deployments', query: [
                'limit' => $limit,
                'projectId' => $projectId,
                'states' => count($states) > 0 ? null : strtoupper(implode(',', $states)),
                'target' => isset($target) ? $target : null,
                'since' => isset($since) ? $since : null,
            ]);

            if (!$response->successful()) throw new HttpException($response->status(), $this->extractErrorMessageFromResponse($response));

            $data =  $response->json();

            return new VercelDeploymentsResult(
                VercelDeploymentDto::collection($data['deployments']),
                VercelPaginationDto::from($data['pagination'])
            );
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }
    }

    public function findOne(string $id): VercelDeploymentDto
    {
        try {
            $response = $this->get(url: '/v13/deployments/' . $id, query: [
                'withGitRepoInfo' => true,
            ]);

            if (!$response->successful()) throw new HttpException($response->status(), $this->extractErrorMessageFromResponse($response));

            $data = $response->json();

            $data = $this->mapVercelKeyDifferents($data);

            return new VercelDeploymentDto($data['id'], $data['name'], $data['url'], $data['state'], VercelDeploymentCreatorDto::from($data['creator']), VercelDeploymentMetaDto::from($data['meta']), $data['alias']);
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }
    }

    public function remove(string $id): VercelDeploymentDeleteDto
    {
        try {
            $response = $this->delete(url: '/v13/deployments/' . $id);

            if (!$response->successful()) throw new HttpException($response->status(), $this->extractErrorMessageFromResponse($response));

            $data = $response->json();

            return VercelDeploymentDeleteDto::from($data);
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }
    }

    public function latestDeployment(): VercelDeploymentDto
    {
        $result = $this->find(projectId: $this->getProjectId(), limit: 1);

        if (count($result->deployments) == 0) throw new HttpException(Response::HTTP_NOT_FOUND, 'no deployments found');

        $latestDeployment =  array_first($result->deployments);

        if (!$latestDeployment) return null;

        return $this->findOne($latestDeployment->id);
    }

    public function latestPreviewDeployment(): VercelDeploymentDto
    {
        $result = $this->find(projectId: $this->getProjectId(), limit: 1, target: 'preview');

        if (count($result->deployments) == 0) throw new HttpException(Response::HTTP_NOT_FOUND, 'no deployments found');

        $latestDeployment =  array_first($result->deployments);

        if (!$latestDeployment) return null;

        return $this->findOne($latestDeployment->id);
    }

    public function latestProductionDeployment(): VercelDeploymentDto
    {
        $result = $this->find(projectId: $this->getProjectId(), limit: 1, target: 'production');

        if (count($result->deployments) == 0) throw new HttpException(Response::HTTP_NOT_FOUND, 'no deployments found');

        $latestDeployment =  array_first($result->deployments);

        if (!$latestDeployment) return null;

        return $this->findOne($latestDeployment->id);
    }

    public function latestDeploymentByTarget(string $target): VercelDeploymentDto
    {
        switch ($target) {
            case 'prodcution':
                return $this->latestProductionDeployment();
            case 'preview':
                return $this->latestPreviewDeployment();
        }
    }

    // Mapping for different key names of vercel api und Laravel-Data versteht nur einen Mapping-Key;
    private function mapVercelKeyDifferents(array $data): array
    {
        if (isset($data['status']))
            $data['state'] = VercelStates::from($data['status']);

        return $data;
    }
}
