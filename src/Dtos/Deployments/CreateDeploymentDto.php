<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Deployments;

use Spatie\LaravelData\Data;

class CreateDeploymentDto extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $deploymentId
    ) {
    }
}
