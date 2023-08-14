<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Domains;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;


class VercelDomainDto extends Data
{

    public function __construct(
        #[MapName('id')]
        public string $id,
        #[MapName('name')]
        public string $name,
        #[MapName('renew')]
        public bool $renew,
        #[MapName('serviceType')]
        public string $serviceType,
        #[MapName('cdnEnabled')]
        public bool $cdnEnabled,
        #[MapName('verified')]
        public bool $verified,
        #[MapName('nameservers')]
        public array $nameservers,
    ) {
    }
}
