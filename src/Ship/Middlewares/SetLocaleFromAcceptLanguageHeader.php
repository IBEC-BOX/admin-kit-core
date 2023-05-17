<?php

namespace AdminKit\Core\Ship\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SetLocaleFromAcceptLanguageHeader
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->parseHttpLocale($request);
        app()->setLocale($locale);

        return $next($request);
    }

    private function parseHttpLocale(Request $request): string
    {
        $defaultLocale = app()->getLocale();
        $localeList = config('admin-kit.locales', [$defaultLocale]);
        $list = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE', $defaultLocale));

        $locales = Collection::make($list)
            ->map(function ($locale) {
                $parts = explode(';', $locale);

                $mapping['locale'] = trim($parts[0]);

                if (isset($parts[1])) {
                    $factorParts = explode('=', $parts[1]);

                    $mapping['factor'] = $factorParts[1];
                } else {
                    $mapping['factor'] = 1;
                }

                return $mapping;
            })
            ->sortByDesc(fn($locale) => $locale['factor'])
            ->filter(fn($locale) => in_array($locale['locale'], $localeList));

        return $locales->first() ? $locales->first()['locale'] : $defaultLocale;
    }

}
