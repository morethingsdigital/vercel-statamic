<?php

namespace Morethingsdigital\VercelStatamic\Services;

use Illuminate\Support\Facades\Log;

use Symfony\Component\HttpKernel\Exception\HttpException;

class WebhookService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
    }

   public function create() {
    try {
        $response = $this->post(url: '/v1/webhooks', body: $createDeploymentDto->toArray(), query: [
            'forceNew' => $forceNew == false ? 0 : 1,
            'skipAutoDetectionConfirmation' => $skipAutoDetectionConfirmation == false ? 0 : 1,
        ]);

        if (!$response->successful()) throw new HttpException($response->status(), $this->extractErrorMessageFromResponse($response));

        $data = $response->json();

        Log::info($data);


        return new VercelDeploymentDto($data['id'], $data['name'], $data['url'], $data['state'], VercelDeploymentCreatorDto::from($data['creator']), VercelDeploymentMetaDto::from($data['meta']));
    } catch (HttpException $exception) {
        throw new HttpException($exception->getStatusCode(), $exception->getMessage());
    }
   }
}
