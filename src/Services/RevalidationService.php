<?php

namespace Morethingsdigital\VercelStatamic\Services;

use Illuminate\Support\Facades\Http;
use Statamic\Facades\Collection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RevalidationService
{
    private $customKeyNameCollections = 'collections';
    private $customKeyNameGloblas = 'globals';
    private $customKeyNameNavigation = 'navigation';
    private $customKeyNameAll = 'all';

    public function __construct()
    {
    }

    public function create(string $baseUrl, string $tag): bool
    {
        try {
            $response =  Http::withHeaders([
                'Content-Type' => 'application/json',
                // 'Authorization' => 'Bearer ' . $this->getAccessToken()
            ])
                ->withQueryParameters(parameters: ['tag' => $tag])
                ->post(url: $baseUrl . '/api/revalidation', data: []);

            if (!$response->successful()) throw new HttpException($response->status(), $response->clientError());

            return true;
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }
    }

    public function purgeAll(string $baseUrl): array
    {
        $invalidatedTags = [];

        $tags = $this->getAllTags();

        foreach ($tags as $tag) {
            $invalidatedTags[$tag] = $this->create($baseUrl, $tag);
        }

        return $invalidatedTags;
    }

    public function isEnabled(): bool
    {
        return config('statamic.vercel.tag_based_revalidation');
    }

    public function getAllTags(): array
    {
        return array_merge($this->getAllCollectionHandles(), [
            $this->customKeyNameNavigation,
            $this->customKeyNameGloblas,
        ]);
    }

    public function hasCustomTagRevalidation(): bool
    {
        $customTags = $this->getCustomTags();

        return isset($customTags) && is_array($customTags);
    }

    public function generateCollectionTags(string $handle): array
    {
        $defaultTags = [$handle];

        if ($this->hasCustomTagRevalidation()) {
            $customTags = $this->getCustomTags();

            if (!array_key_exists($this->customKeyNameCollections, $customTags)) throw new HttpException(Response::HTTP_BAD_REQUEST, $this->customKeyNameCollections  . ' is not defined in custom tags revalidation');

            $typeTags = $customTags[$this->customKeyNameCollections];

            if (!array_key_exists($handle, $typeTags))  throw new HttpException(Response::HTTP_BAD_REQUEST, $handle  . ' is not defined in custom tags revalidation of ' . $this->customKeyNameCollections);

            $handleTags = array_values($typeTags[$handle]);

            if (isset($handleTags)) {
                return $handleTags;
            }
        }

        return $defaultTags;
    }

    public function generateNavigationTags()
    {
        $defaultTags = [$this->customKeyNameNavigation];

        if ($this->hasCustomTagRevalidation()) {
            $customTags = $this->getCustomTags();

            if (!array_key_exists($this->customKeyNameNavigation, $customTags)) throw new HttpException(Response::HTTP_BAD_REQUEST, $this->customKeyNameNavigation . ' is not defined in custom tags revalidation');

            if (isset($customTags[$this->customKeyNameNavigation])) {
                return $customTags[$this->customKeyNameNavigation];
            }
        }

        return $defaultTags;
    }

    public function generateGlobalTags()
    {
        $defaultTags = [$this->customKeyNameGloblas];

        if ($this->hasCustomTagRevalidation()) {
            $customTags = $this->getCustomTags();

            if (!array_key_exists($this->customKeyNameGloblas, $customTags)) throw new HttpException(Response::HTTP_BAD_REQUEST, $this->customKeyNameGloblas . ' is not defined in custom tags revalidation');

            if (isset($customTags[$this->customKeyNameGloblas])) {
                return $customTags[$this->customKeyNameGloblas];
            }
        }

        return $defaultTags;
    }

    private function getAllCollectionHandles(): array
    {
        return Collection::all()->map(fn ($collection) => $collection->handle())->toArray();
    }

    private function getCustomTags(): array
    {
        return config('statamic.vercel.custom_tag_revalidation');
    }
}
