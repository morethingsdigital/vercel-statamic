<?php

namespace Morethingsdigital\VercelStatamic\Services\Vercel;

use Morethingsdigital\VercelStatamic\Dtos\Vercel\Common\VercelPaginationDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Domains\VercelDomainDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Domains\VercelDomainsResult;
use Morethingsdigital\VercelStatamic\Services\BaseService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DomainService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
    }


    public function find(string $projectId, int $limit = 20, int $since = null, int $until = null): VercelDomainsResult
    {
        try {
            $response = $this->get(url: '/v5/domains', query: [
                'limit' => $limit,
                'projectId' => $projectId,
                'until' => isset($until) ? $until : null,
                'since' => isset($since) ? $since : null,
            ]);

            if (!$response->successful()) throw new HttpException($response->status(), $this->extractErrorMessageFromResponse($response));

            $data =  $response->json();

            return new VercelDomainsResult(
                VercelDomainDto::collection($data['domains']),
                VercelPaginationDto::from($data['pagination'])
            );
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }
    }
}
