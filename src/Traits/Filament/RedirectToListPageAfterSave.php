<?php
declare(strict_types=1);
namespace AdminKit\Core\Traits\Filament;

trait RedirectToListPageAfterSave
{
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }
}