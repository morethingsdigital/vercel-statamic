<?php

namespace Morethingsdigital\VercelStatamic\Dtos\Vercel\Common;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;

class VercelPaginationDto extends Data
{

    public function __construct(
        #[MapName('count')]
        public int $count,
        #[MapName('next')]
        public ?int $next = null,
        #[MapName('prev')]
        public ?int $prev = null
    ) {
    }
}
