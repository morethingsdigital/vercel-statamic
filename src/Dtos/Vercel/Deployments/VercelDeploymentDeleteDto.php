<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments;

use Morethingsdigital\VercelStatamic\Enums\VercelStates;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

class VercelDeploymentDeleteDto extends Data
{

    public function __construct(
        #[MapName('uid')]
        public string $id,
        #[MapName('state')]
        #[WithCast(EnumCast::class, type: VercelStates::class)]
        public VercelStates $state,
    ) {
    }
}
