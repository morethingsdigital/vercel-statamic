<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Webhooks;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;

class VercelWebhookDto extends Data
{

    public function __construct(
        #[MapName('id')]
        public string $id,
        #[MapName('events')]
        public array $events,
        #[MapName('secret')]
        public string $secret,
        #[MapName('url')]
        public string $url,
        #[MapName('ownerId')]
        public string $ownerId,
        #[MapName('createdAt')]
        public string $createdAt,
        #[MapName('updatedAt')]
        public string $updatedAt,
        #[MapName('projectIds')]
        public array $projectIds,
    ) {
    }
}
