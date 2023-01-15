<?php

namespace AdminKit\Core\Models;

use Illuminate\Database\Eloquent\Model;

class AdminKitModel extends Model
{
    /**
     * Save to database cyrillic characters
     *
     * @param $value
     * @return false|string
     */
    public function asJson($value): bool|string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
