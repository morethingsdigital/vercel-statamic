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
        public ?int $prev = null,
        public int $limit = 10
    ) {
    }

    public function currentPage() {
        return floor($this->count / $this->limit);
    }

    public function nextPage() {
        if($this->next) return $this->currentPage() + 1;

        return null;
    }

    public function lastPage() {
        if($this->prev) return $this->currentPage() - 1;

        return null;
    }
}
