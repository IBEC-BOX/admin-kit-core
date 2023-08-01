<?php

// config for AdminKit/Core
return [
    /*
     * Информация о разработчике
     */
    'developer' => 'iBEC Systems '.date('Y'),

    /*
     * Мультиязычность админ панели.
     * Так же используется Фасад AdminKit\Core\Facades\AdminKit::locales()
     */
    'locales' => ['ru', 'kk', 'en'],

    /*
     * Timezone для отображения в админ панели Filament,
     * при сохранении в базу данных используется UTC config('app.timezone')
     */
    'timezone' => 'Asia/Almaty',

    'user' => [
        /*
         * User Model
         */
        'model' => 'App\Models\AdminKitUser',

        /*
         * The Group name of the resource.
         */
        'group' => 'Filament Shield',

        /*
         * User Filament Impersonate
         */
        'impersonate' => true,

        /*
         * User Filament Shield
         */
        'shield' => true,
    ],
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
