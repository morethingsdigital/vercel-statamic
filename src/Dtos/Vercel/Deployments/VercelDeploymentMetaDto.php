<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Deployments;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;

class VercelDeploymentMetaDto extends Data
{

    public function __construct(
        #[MapName('githubRepo')]
        public string $repo,
        #[MapName('githubOrg')]
        public string $organisation,
        #[MapName('githubCommitRef')]
        public string $branch,
        #[MapName('githubCommitSha')]
        public string $sha
    ) {
    }
}
