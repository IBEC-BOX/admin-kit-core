<?php

use AdminKit\Core\UI\Filament\Resources\UserResource;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

// config for AdminKit/Core
return [
    /*
     * Информация о разработчике
     */
    'developer' => 'iBEC Systems '.date('Y'),

    /*
     * Мультиязычность админ панели.
     * Так же можно использовать AdminKit\Core\Facades\AdminKit::locales()
     */
    'locales' => ['ru', 'kk', 'en'],

    /*
     * Timezone для отображения в админ панели Filament,
     * при сохранении в базу данных используется UTC config('app.timezone')
     * Так же можно использовать AdminKit\Core\Facades\AdminKit::timezone()
     */
    'timezone' => 'Asia/Almaty',

    /*
     * Настройки админ панели Filament v3
     */
    'panel' => [
        'brand_name' => env('APP_NAME'),

        'auth_guard' => env('FILAMENT_AUTH_GUARD', 'admin-kit-web'),

        'domain' => env('FILAMENT_DOMAIN'),
        'path' => env('FILAMENT_PATH', 'admin'),
        'home_url' => env('FILAMENT_PATH', 'admin'),

        'colors' => [
            'primary' => Filament\Support\Colors\Color::Amber,
        ],

        'resources' => [
            UserResource::class,
            RoleResource::class,
        ],
        'pages' => [
            Filament\Pages\Dashboard::class,
        ],
        'widgets' => [
            Filament\Widgets\AccountWidget::class,
            Filament\Widgets\FilamentInfoWidget::class,
        ],
        'plugins' => [
            BezhanSalleh\FilamentShield\FilamentShieldPlugin::class,
        ],

        'middleware' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ],
        'authMiddleware' => [
            Authenticate::class,
        ],

        'discover_pages' => [
            'in' => app_path('Filament/Pages'),
            'for' => 'App\Filament\Pages',
        ],
        'discover_resources' => [
            'in' => app_path('Filament/Resources'),
            'for' => 'App\Filament\Resources',
        ],
        'discover_widgets' => [
            'in' => app_path('Filament/Widgets'),
            'for' => 'App\Filament\Widgets',
        ],
    ],

    /*
     * Модуль "Пользователи" админ панели
     */
    'user' => [
        'model' => 'App\Models\AdminKitUser',
        'slug' => 'admin-users',
        'group' => 'Filament Shield',
        'impersonate' => true,
        'shield' => true,
    ],

    /*
     * Настройки доступа к админ панели
     */
    'adminWhiteIps' => [
        'white_list_enable' => env('ADMIN_WHITE_LIST_ENABLE', false),
        'white_list_access_by_token_enable' => env('ADMIN_WHITE_LIST_ACCESS_BY_TOKEN_ENABLE', false),
        'token' => env('ADMIN_WHITE_LIST_TOKEN', 'g9M5f3MGRQpB6vP3WSVaVVzemwYfqrpm'),
        'list' => [
            [
                'ip' => '46.34.147.110',
                'subnet' => null,
                'description' => 'IBEC VPN Almaty new',
            ],
            [
                'ip' => '130.61.22.113',
                'subnet' => null,
                'description' => 'IBEC VPN DevOps rezerv',
            ],
            [
                'ip' => '130.61.175.129',
                'subnet' => null,
                'description' => 'IBEC Frankfurt Oracle Cloud rezerv',
            ],
        ],
    ],

];
