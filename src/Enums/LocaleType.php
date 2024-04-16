<?php

declare(strict_types=1);

namespace AdminKit\Core\Enums;

enum LocaleType: string
{
    case Code = 'code';
    case Title = 'title';
    case Native = 'native';
}
