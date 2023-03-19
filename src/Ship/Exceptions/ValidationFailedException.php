<?php

namespace AdminKit\Core\Ship\Exceptions;

use AdminKit\Core\Ship\Parents\Exceptions\ParentException;
use Symfony\Component\HttpFoundation\Response;

class ValidationFailedException extends ParentException
{
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;
    protected $message = 'Invalid Input.';
}
