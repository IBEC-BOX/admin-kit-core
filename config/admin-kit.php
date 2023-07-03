<?php

// config for AdminKit/Core
return [
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
                'ip' => '188.0.151.149',
                'subnet' => null,
                'description' => 'IBEC Systems',
            ],
        ],
    ],

];
