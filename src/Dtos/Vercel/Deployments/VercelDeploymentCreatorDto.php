<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;

class VercelDeploymentCreatorDto extends Data
{

    public function __construct(
        #[MapName('uid')]
        public string $id,
        #[MapName('username')]
        public string $name,
        #[MapName('email')]
        public ?string $email = null
    ) {
    }
}
