<?php

declare(strict_types=1);

namespace AdminKit\Core\DTO;

use Spatie\LaravelData\Data;

class LocaleData extends Data
{
    public string $title;

    public string $native;

    public function __construct(
        public string $code,
    ) {
        $this->title = __("admin-kit::language.$this->code");
        $this->native = __(key: "admin-kit::language.$this->code", locale: $this->code);
    }
}
