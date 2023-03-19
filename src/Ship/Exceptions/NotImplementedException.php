<?php

namespace AdminKit\Core\Ship\Exceptions;

use AdminKit\Core\Ship\Parents\Exceptions\ParentException;
use Symfony\Component\HttpFoundation\Response;

class NotImplementedException extends ParentException
{
    protected $code = Response::HTTP_NOT_IMPLEMENTED;
    protected $message = 'This method is not yet implemented.';
}
