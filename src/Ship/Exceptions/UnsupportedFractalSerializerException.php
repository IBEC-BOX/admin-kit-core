<?php

namespace AdminKit\Core\Ship\Exceptions;

use AdminKit\Core\Ship\Parents\Exceptions\ParentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UnsupportedFractalSerializerException extends ParentException
{
    protected $code = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'Unsupported Fractal Serializer!';
}
