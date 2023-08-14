<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Domains;

use Morethingsdigital\VercelStatamic\Dtos\Vercel\Common\VercelPaginationDto;
use Morethingsdigital\VercelStatamic\Dtos\Vercel\Domains\VercelDomainDto;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class VercelDomainsResult extends Data
{

    public function __construct(
        #[DataCollectionOf(VercelDomainDto::class)]
        public DataCollection $domains,
        public VercelPaginationDto $pagination
    ) {
    }
}
