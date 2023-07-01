<?php

// config for AdminKit/Core
return [
    'locales' => ['ru', 'en', 'kk'],

    /*
     * Timezone для отображения в админ панели Filament,
     * при сохранении используется config('app.timezone')
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
];
