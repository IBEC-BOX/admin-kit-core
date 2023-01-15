<?php

namespace AdminKit\Core\Models;

class AdminKitModel
{
    /**
     * Save to database cyrillic characters
     *
     * @param $value
     * @return false|string
     */
    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
