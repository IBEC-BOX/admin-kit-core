<?php

namespace AdminKit\Core\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!config('admin-kit.user.password.expiry.enabled')) {
            return $next($request);
        }

        $user = auth()->user();

        if (!$user?->password_expires_at) {
            return $next($request);
        }

        if (now()->greaterThanOrEqualTo($user->password_expires_at) && !$this->isExcludedRoute()) {
            return redirect()->route('filament.admin-kit.pages.password-expired');
        }

        return $next($request);
    }

    private function isExcludedRoute(): bool
    {
        $excludedRoutes = [
            'filament.admin-kit.pages.password-expired', // Страница истекшего пароля
            'filament.admin-kit.auth.logout',            // Страница выхода
        ];

        return in_array(Route::currentRouteName(), $excludedRoutes, true);
    }
}
