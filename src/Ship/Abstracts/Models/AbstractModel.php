<?php

namespace AdminKit\Core\Ship\Abstracts\Models;

use AdminKit\Porto\Traits\CyrillicChars;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as LaravelEloquentModel;

abstract class AbstractModel extends LaravelEloquentModel
{
    use HasFactory;
    use CyrillicChars;
}
