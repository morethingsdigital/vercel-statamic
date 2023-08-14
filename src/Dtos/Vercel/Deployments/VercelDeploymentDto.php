<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments;

use Illuminate\Support\Facades\Log;
use Morethingsdigital\VercelStatamic\Enums\VercelStates;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

class VercelDeploymentDto extends Data
{

    public string $environment;

    public function __construct(
        #[MapName('uid')]
        public string $id,
        #[MapName('name')]
        public string $name,
        #[MapName('url')]
        public string $domain,
        #[MapName('state')]
        #[WithCast(EnumCast::class, type: VercelStates::class)]
        public VercelStates $state,
        #[MapName('creator')]
        public VercelDeploymentCreatorDto $creator,
        #[MapName('meta')]
        public VercelDeploymentMetaDto $meta,
        #[MapName('alias')]
        public ?array $alias = [],
        #[MapName('target')]
        ?string $target = null
    ) {
        Log::info($target);
        $this->environment = $target === null ? 'preview' : $target;
    }
}
