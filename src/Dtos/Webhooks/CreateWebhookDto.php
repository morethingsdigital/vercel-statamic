<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Webhooks;

use Spatie\LaravelData\Data;

class CreateWebhookDto extends Data
{

    public function __construct(
        public array $events,
        public string $url,
        public ?array $projectIds = []
    ) {
    }
}
