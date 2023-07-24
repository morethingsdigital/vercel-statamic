<?php

namespace Morethingsdigital\VercelStatamic\Services;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseService
{

    private $baseUri = 'https://api.vercel.com';
    protected $httpService;


    public function __construct()
    {
        $this->httpService = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getAccessToken()
        ])->baseUrl($this->baseUri)->withUrlParameters($this->getDefaultUrlParams());
    }

    private function getDefaultUrlParams()
    {
        return [
            'teamId' => $this->getTeamId()
        ];
    }

    private function getAccessToken(): string
    {
        return config('statamic.vercel.token');
    }

    private function getTeamId(): string
    {
        return config('statamic.vercel.team_id');
    }

    public function getProjectId(): string
    {
        return config('statamic.vercel.project_id');
    }

    // protected function setQueryParams(array $params)
    // {
    //     $this->httpService->withQueryParameters(array_merge($params, $this->getDefaultUrlParams()));
    // }

    protected function handleError(HttpException $exception)
    {
        return $exception->getMessage();
    }

    protected function extractErrorMessageFromResponse(ClientResponse $response)
    {
        return $response->json()['error']['message'];
    }


    // Own http methods wrapper
    public function get(string $url, array $query = [], array $headers = []): ClientResponse
    {
        return $this->httpService->withHeaders($headers)->get(url: $url, query: array_merge($query, $this->getDefaultUrlParams()));
    }

    public function post(string $url, array $body = [], array $query = [], array $headers = []): ClientResponse
    {
        Log::info(array_merge($query, $this->getDefaultUrlParams()));
        return $this->httpService->withHeaders($headers)->withQueryParameters(array_merge($query, $this->getDefaultUrlParams()))->post(url: $url, data: $body);
    }

    public function patch(string $url, array $body = [], array $query = [], array $headers = []): ClientResponse
    {
        return $this->httpService->withHeaders($headers)->withQueryParameters(array_merge($query, $this->getDefaultUrlParams()))->patch(url: $url, data: $body);
    }

    public function put(string $url, array $body = [], array $query = [], array $headers = []): ClientResponse
    {
        return $this->httpService->withHeaders($headers)->withQueryParameters(array_merge($query, $this->getDefaultUrlParams()))->put(url: $url, data: $body);
    }

    public function delete(string $url, array $body = [], array $query = [], array $headers = []): ClientResponse
    {
        return $this->httpService->withHeaders($headers)->withQueryParameters(array_merge($query, $this->getDefaultUrlParams()))->delete(url: $url, data: $body);
    }
}
