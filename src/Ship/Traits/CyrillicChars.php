<?php

namespace AdminKit\Core\Ship\Traits;

trait CyrillicChars
{
    /**
     * save cyrillic characters to the database
     */
    public function asJson(mixed $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
