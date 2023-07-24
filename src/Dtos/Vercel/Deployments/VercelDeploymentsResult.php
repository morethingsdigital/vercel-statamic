<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments;

use Morethingsdigital\VercelStatamic\Dtos\Vercel\Common\VercelPaginationDto;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class VercelDeploymentsResult extends Data
{

    public function __construct(
        #[DataCollectionOf(VercelDeploymentDto::class)]
        public DataCollection $deployments,
        public VercelPaginationDto $pagination
    ) {
    }
}
