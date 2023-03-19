<?php

namespace AdminKit\Core\Ship\Exceptions;

use AdminKit\Core\Ship\Parents\Exceptions\ParentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class InternalErrorException extends ParentException
{
    protected $code = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'Something went wrong!';
}
