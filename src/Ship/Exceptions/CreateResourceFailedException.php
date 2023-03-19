<?php

namespace AdminKit\Core\Ship\Exceptions;

use AdminKit\Core\Ship\Parents\Exceptions\ParentException;
use Symfony\Component\HttpFoundation\Response;

class CreateResourceFailedException extends ParentException
{
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    protected $message = 'Failed to create Resource.';
}
