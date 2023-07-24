<?php

namespace Morethingsdigital\VercelStatamic\Services;

use Nette\NotImplementedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class WebhookService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        try {
            throw new NotImplementedException();
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }
    }
}
