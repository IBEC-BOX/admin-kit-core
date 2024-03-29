<?php

namespace AdminKit\Core\Abstracts\Models;

use AdminKit\Core\Traits\CyrillicChars;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as LaravelEloquentModel;

abstract class AbstractModel extends LaravelEloquentModel
{
    use CyrillicChars;
    use HasFactory;
}
